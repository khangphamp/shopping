<?php 
namespace App\Traits;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
trait StrorageImageTrait {
    public function storageTraitUpload($request,$filename,$foderName){
       
        // $filename là name ở form khi dc upload
        if($request->hasFile($filename)){
            $file = $request->$filename;
            $namefileOrigin = $file->getClientOriginalName();
            $namefileHash = Str::random(20) . '.'.$file->getClientOriginalExtension(); 
            $filepath = $request->file($filename)->storeAs('public/'.$foderName.'/'.auth()->id(),$namefileHash);
            $dataUpload = [
                'filename' => $namefileOrigin,
                'filepath'=>Storage::url($filepath),
            ];
            return $dataUpload;
            
        }
        return null;
  
    }
    public function storageTraitUploadMutiple($file,$foderName){

        // $filename là name ở form khi dc upload
            $namefileOrigin = $file->getClientOriginalName();
            $namefileHash = Str::random(20) . '.'.$file->getClientOriginalExtension(); 
            $filepath = $file->storeAs('public/'.$foderName.'/'.auth()->id(),$namefileHash);
            $dataUpload = [
                'filename' => $namefileOrigin,
                'filepath'=>Storage::url($filepath),
            ];
            return $dataUpload;
            

  
    }
}