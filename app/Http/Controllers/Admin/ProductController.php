<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Components\Recursive;
use App\Http\Requests\ProductAddRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductTag;
use App\Traits\StrorageImageTrait;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    use StrorageImageTrait;
    private $category;
    private $product;
    private $productImage;
    private $tag;
    private $ProductTag;
    public function __construct(Category $category,Product $product,ProductImage $productImage,Tag $tag,ProductTag $ProductTag){
        $this->category = $category;
        $this->product = $product;
        $this->productImage = $productImage;
        $this->tag = $tag;
        $this->ProductTag = $ProductTag;
    }
    public function index(){
        $Listproduct= $this->product->latest()->paginate(5);
        return view('admin.product.index',compact('Listproduct'));
    }
    public function create(){
        $htmlOption = $this ->getCategory(null);
        return view('admin.product.add',compact('htmlOption'));
    }
    public function getCategory($parent_id){
        $data =$this->category->all();
        $recursive = new Recursive($data);
        $htmlOption = $recursive -> CategoryRecursive($parent_id);
        return $htmlOption;
    }
    public function store(ProductAddRequest $request){
        try {
            DB::beginTransaction();
            $dataProductCreate=[
                'name'=>$request -> name,
                'price'=>$request -> price,
                'content'=>$request ->content,
                'user_id'=>auth()->id(),
                'category_id'=>$request -> category_id
            ];
            $dataUploadFeatureImage = $this->storageTraitUpload( $request,'feature_image_path','product');
            if(!empty($dataUploadFeatureImage)){
                $dataProductCreate['feature_image_name']=$dataUploadFeatureImage['filename'];
                $dataProductCreate['feature_image_path']=$dataUploadFeatureImage['filepath'];
            }
            $product=$this->product->create($dataProductCreate);
            // insert data to product_images
            if($request->hasFile('image_path')){
                foreach($request->image_path as $fileItem){
                    $dataProductImageDetail =$this->storageTraitUploadMutiple($fileItem,'product');
                    $product->images()->create([
                        'image_path'=>$dataProductImageDetail['filepath'],
                        'image_name'=>$dataProductImageDetail['filename'],
                    ]);
                }
            }
            // insert tag to product_tag
            if(!empty($$request->tags)){
                $tags_id=collect([]);
                foreach ($request->tags as $tag){
                    // them vào bảng tags
                    $tag=$this->tag->firstOrCreate([
                        'name'=>$tag
                    ]);
                    $tags_id->push($tag->id);
                }
                $product->tags()->attach($tags_id->all());
            }
            
            DB::commit();
            return redirect()->route('products.index');
           
        }
        catch(\Exception $exception){
            DB::rollBack();
            return $exception->getMessage() . $exception->getLine();
        }
       
    }
    public function edit($id){  
        $productEdit = $this->product->find($id);
        $htmlOption = $this ->getCategory($productEdit->category_id);
        return view('admin.product.edit',compact('productEdit','htmlOption'));
    }
    public function update(Request $request,$id){
        try {
            DB::beginTransaction();
            $dataProductUpdate=[
                'name'=>$request -> name,
                'price'=>$request -> price,
                'content'=>$request ->content,
                'user_id'=>auth()->id(),
                'category_id'=>$request -> category_id
            ];
            $dataUploadFeatureImage = $this->storageTraitUpload( $request,'feature_image_path','product');
            if(!empty($dataUploadFeatureImage)){
                $dataProductUpdate['feature_image_name']=$dataUploadFeatureImage['filename'];
                $dataProductUpdate['feature_image_path']=$dataUploadFeatureImage['filepath'];
            }
            $this->product->find($id)->update($dataProductUpdate);
            $product= $this->product->find($id);
            // insert data to product_images
            $deleteImage = $this->productImage->where('product_id',$id)->get();
            foreach($deleteImage as $item){
                
              Storage::delete(str_replace('storage','public',$item->image_path));
    
            }
        
            if($request->hasFile('image_path')){
                $this->productImage->where('product_id',$id)->delete();
                foreach($request->image_path as $fileItem){
                    $dataProductImageDetail =$this->storageTraitUploadMutiple($fileItem,'product');
                    $product->images()->create([
                        'image_path'=>$dataProductImageDetail['filepath'],
                        'image_name'=>$dataProductImageDetail['filename'],
                    ]);
                }
            }
            // insert tag to product_tag
            if(!empty($request->tags)){
                $tags_id=collect([]);
                foreach ($request->tags as $tag){
                    // them vào bảng tags
                    $tag=$this->tag->firstOrCreate([
                        'name'=>$tag
                    ]);
                    $tags_id->push($tag->id);
                }
                $product->tags()->sync($tags_id->all());
            }
            
            DB::commit();
            return redirect()->route('products.index');
           
        }
        catch(\Exception $exception){
            DB::rollBack();
            return $exception->getMessage() . $exception->getLine();
        }
    }
    public function delete($id){
        $deleteProduct = $this->product->find($id);
        $deleteProduct->delete();
        $this->productImage->where('product_id',$id)->delete();
        $deleteProduct->tags()->detach();
        return redirect()->route('products.index');
    }
    
}
