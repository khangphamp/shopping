<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use App\Components\MenuRecursive;
use Illuminate\Support\Str;
class MenuController extends Controller
{
    private $menu;
    private $menuRecursive;
    public function __construct(Menu $menu,MenuRecursive $menuRecursive){
        $this->menu = $menu;
        $this->menuRecursive = $menuRecursive;
    }
    public function index(){
        $ListMenu = $this->menu->paginate(5);
        return view('Admin.menu.index',compact('ListMenu'));
    } 
    public function create(){
        $htmlOption = $this->menuRecursive->MenuRecursiveAdd();
        return view('Admin.menu.add',compact('htmlOption'));
    }
    public function store(Request $request){
        $this->menu->create([
            'name'=>$request->name,
            'parent_id'=>$request->parent_id,
            'slug'=>Str::slug($request->name),
        ]);
        return redirect()->route('menus.index');
    }
    public function edit($id){
        $menu = $this->menu->find($id);
        $htmlOption = $this->menuRecursive->MenuRecursiveEdit($menu->parent_id);
        return view('Admin.menu.edit',compact('menu','htmlOption'));
    }
    public function update(Request $request,$id){
        $menu = $this->menu->find($id);
        $menu->name = $request->name;
        $menu->parent_id = $request->parent_id;
        $menu->slug = Str::slug($request->name);
        $menu->save();
        return redirect()->route('menus.index');
    }
    public function delete($id){
        $this->menu->find($id)->delete();
        return redirect()->route('menus.index');
    }
}
