<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Psy\Command\EditCommand;

class AdminController extends Controller
{
    public function login(){
        if(auth()->check()){
            return redirect()->route('home');
        }
        return view('admin.admin.login');
    }
    public function checkLogin(Request $request){
        $email = $request->email;
        $password = $request->password;
        if(Auth::attempt([ 'email' =>$email,'password'=> $password ])){ 
            return redirect()->route('home');
        }
        else{
            echo "ban sai tài khoản ";
        }
    }
}
