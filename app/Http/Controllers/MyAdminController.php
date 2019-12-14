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
        $this->middleware('auth:myadmin',['except' => ['register', 'index','initial','login']]);
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
    public function index($secret){
        if(!Auth::guard('myadmin')->check()){
            $chk=MyAdmin::where('secret_key',$secret)->first();
            if(empty($chk)){
                return redirect('/');
            }
            return view('Auth/myadminlogin',compact('secret'));
        }else{
            $page="Admin DB";
            $admincount=MyAdmin::count();
            return view('myadmin/index',compact('page','secret','admincount'));
        }
    }
    public function login(Request $request,$secret){
        $secretmatch=MyAdmin::where('email',$request['email'])->where('secret_key',$secret)->first();
        if(!empty($secretmatch)) {
            if (Auth::guard('myadmin')->attempt($request->except(['_token', '_method']))) {
                return back();
            } else {
                return redirect('/');
            }
        }else{
            $error = \Illuminate\Validation\ValidationException::withMessages([
                'email' => ['email not match secret key in url'],
            ]);
            throw $error;
        }
    }
    public function info($secret){
        $page='Info';
        return view('myadmin/info',compact('secret','page'));
    }
    public function master($secret){
        $page='Master';
        return view('myadmin/master',compact('secret','page'));
    }
}
