<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    private $setting;
    public function __construct(Setting $setting){
        $this->setting = $setting;
    }
    public function index(){
        $listsetting=$this->setting->all();
        return view('admin.setting.index',compact('listsetting'));
    }
    public function create(){
        return view('admin.setting.add');
    }
    public function store(Request $request){
        $this->setting ->create([
            'config_key'=> $request->config_key,
            'config_value'=> $request->config_value,
            'type'=> $request->type
        ]);
        return redirect()->route('settings.index');
    }
    public function edit($id){
        $setting = $this->setting->find($id);
        return view('admin.setting.edit', compact('setting'));
    }
    public function update(Request $request,$id){
        $this->setting->find($id)->update([
            'config_key'=>$request->config_key,
            'config_value'=> $request->config_value
        ]);
        return redirect()->route('settings.index');
    }
    public function delete($id){
        $this->setting->find($id)->delete();
        return redirect()->route('settings.index');
    }
}
