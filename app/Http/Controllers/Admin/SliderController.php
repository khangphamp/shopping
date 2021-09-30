<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SliderAddRequest;
use App\Models\Slider;
use Illuminate\Http\Request;
use App\Traits\StrorageImageTrait;
use Illuminate\Support\Facades\DB;

class SliderController extends Controller
{
    use StrorageImageTrait;
    private $slider;
    public function __construct(Slider $slider){
        $this->slider = $slider;
    }
    public function index(){
        $sliderList = $this->slider->paginate(5);
        return view('admin.slider.index',compact('sliderList'));
    }
    public function create(){
        return view('admin.slider.add');
    }
    public function store(SliderAddRequest $request){
    try{
        DB::beginTransaction();
        $dataInsert = ([
            'name' => $request->name
        ]);
        $dataImage = $this->storageTraitUpload($request,'image_path','slider');
        $dataInsert['image_name'] = $dataImage['filename'];
        $dataInsert['image_path'] = $dataImage['filepath'];
 
        $this->slider->create($dataInsert);
       DB::commit();
        return redirect()->route('sliders.index');
    }
    catch(\Exception $e){
        DB::rollBack();
        return $e->getMessage() . $e->getLine();
    }   
      
    }
    public function edit($id){
        $slider = $this->slider->find($id);
        return view('admin.slider.edit',compact('slider'));
    }
    public function update(Request $request, $id){
        try{
            DB::beginTransaction();
            $dataUpdate = ([
                'name' => $request->name
            ]);
        
            $dataImage = $this->storageTraitUpload($request,'image_path','slider');
            $dataUpdate['image_name'] = $dataImage['filename'];
            $dataUpdate['image_path'] = $dataImage['filepath'];
            $this->slider->find($id)->update(
                $dataUpdate
            );
            DB::commit();
            return redirect()->route('sliders.index');
        }catch(\Exception $e){
            DB::rollBack();
            return $e->getMessage() . $e->getLine();
        }
        
    }
    public function delete($id){
        $this->slider->find($id)->delete();
        return redirect()->route('sliders.index');
    }

}
