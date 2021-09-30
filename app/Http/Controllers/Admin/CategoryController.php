<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Components\Recursive;
use Illuminate\Support\Str;


class CategoryController extends Controller
{
    private $category;
    public function __construct(Category $category){
        $this->category = $category;
    }
    public function index(){
        $ListCategory=$this->category->latest()-> paginate(5);
        return view('Admin.category.index',compact('ListCategory'));
    }
    public function create(){
        $htmlOption = $this ->getCategory(null);
        return view('Admin.category.add',compact('htmlOption'));
    }
    public function store(Request $request){
        $this->category->create([
            'name' => $request->name,
            'parent_id'=>$request->parent_id,
            'slug'=>Str::slug($request->name)
        ]);
        return redirect()->route('categories.create');
    }
    public function getCategory($parent_id){
        $data =$this->category->all();
        $recursive = new Recursive($data);
        $htmlOption = $recursive -> CategoryRecursive($parent_id);
        return $htmlOption;
    }
    public function edit($id){
        $category = $this->category->find($id);
        $htmlOption = $this ->getCategory($category->parent_id);
        return view('Admin.category.edit',compact('category','htmlOption'));

        
    }
    public function update (Request $request,$id){
        $category = $this->category->find($id);
        $category->name = $request->name;
        $category->parent_id =$request->parent_id;
        $category->slug = Str::slug($request->name);
        $category->save();
        return redirect()->route('categories.index');
    }
    public function delete ($id){
        $this->category->find($id)->delete();
        return redirect()->route('categories.index');
    }
    public function storeDelete(){
        $ListCategory=$this->category->onlyTrashed()->get();
        return view('Admin.category.storeDelete',compact('ListCategory'));
    }
    public function restore($id){

        $this->category ->onlyTrashed()
                        ->where('id',$id)
                        ->restore();
        return redirect()->route('categories.storeDelete');
    }

}
