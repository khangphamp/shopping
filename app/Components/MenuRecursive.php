<?php 
namespace App\Components;

use App\Models\Menu;

class MenuRecursive{

    private $html;
    public function __construct()
    {
        $this->html = '';
    }
    public function MenuRecursiveAdd($parent_id = 0,$subMart = ''){
        $data = Menu::where('parent_id',$parent_id)->get();

        foreach($data as $key =>$item){
            $this-> html .="<option value=\"$item->id\">".$subMart.$item->name."</option>";
            $id=$item->id;
            unset($data[$key]);
            $this->MenuRecursiveAdd($id,$subMart.'-');
        }
        return $this->html;
        
    }
    public function MenuRecursiveEdit($checkid,$parent_id=0,$subMart = ''){
        $data = Menu::where('parent_id',$parent_id)->get();

        foreach($data as $key =>$item){
            if($item->id == $checkid){
                $this-> html .="<option selected value=\"$item->id\">".$subMart.$item->name."</option>";
            }  
            else{
                $this-> html .="<option value=\"$item->id\">".$subMart.$item->name."</option>";
            } 
            $id=$item->id;
            unset($data[$key]);
            $this->MenuRecursiveEdit($checkid,$id,$subMart.'-');
        }
        return $this->html;
        
    }
}