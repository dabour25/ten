<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\MyAdmin;
use Session;

class MyAdminController extends Controller
{
    public function __construct(){
        //$this->middleware('auth');
    }

    public function index(){
        return view('welcome');
    }
    public function initial(){
        $admin=MyAdmin::first();
        if(!empty($admin)){
            return redirect('/');
        }
        return view('myadmin/initial');
    }
    public function register(Request $req){
        $this->validate($req, [
            'email'   => 'required|email|unique:myadmin,email',
            'password' => 'required|min:6|regex:/[A-z]*[0-9]+[A-z]*/|confirmed',
            'secret_key' =>'required|min:10|max:10|regex:/[A-z]*[0-9]+[A-z]+[0-9]*[A-z]*/',
        ]);
        $req['password']=Hash::make($req['password']);
        MyAdmin::create($req->except('password_confirmation'));
        return redirect('/myadmin/'.$req['secret_key']);
    }
}
