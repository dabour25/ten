<?php

namespace App\Http\Controllers;

use App\Models\Ui\Master;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\MyAdmin;
use App\Models\Ui\Cssfiles;
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
            $master=Master::all();
            return view('Auth/myadminlogin',compact('secret','master'));
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
        $data=Master::all();
        return view('myadmin/master',compact('secret','page','data'));
    }
    public function editmaster(Request $req,$secret){
        $image=$req->file('icon');
        if(!empty($image)){
            $photosPath = public_path('/images');
            $photoName='logo';
            $photoName.='.'.$image->getClientOriginalExtension();
            $image->move($photosPath,$photoName);
        }else{
            $img=Master::where('id',2)->first();
            $photoName=$img->value;
        }
        Master::where('id',1)->update(['value'=>$req['title']]);
        Master::where('id',2)->update(['value'=>$photoName]);
        Master::where('id',3)->update(['value'=>$req['head']]);
        Master::where('id',4)->update(['value'=>$req['header']]);
        Master::where('id',5)->update(['value'=>$req['footer']]);
        Master::where('id',6)->update(['value'=>$req['scripts']]);
        return back();
    }

    public function cssfiles($secret){
        $page='CSS Info';
        $cssfiles=Cssfiles::all();
        return view('myadmin/cssfiles',compact('secret','page','cssfiles'));
    }

    public function add_css(Request $req){
        $this->validate($req, [
            'cssfile'   => 'required|max:8192',
        ]);
        $file=$req->file('cssfile');
        $path = public_path('/css/ui');
        $name=$file->getClientOriginalName();
        $chkname=Cssfiles::where('file_name',$name)->first();
        if($chkname){
            $error = \Illuminate\Validation\ValidationException::withMessages([
                'file_name' => ['This File Has Been Taken Before'],
            ]);
            throw $error;
        }
        $file->move($path,$name);
        $full_html='css/ui'."/".$name;
        Cssfiles::insert(['file_name'=>$name,'full_html'=>$full_html]);
        Session::put("message","Css File Saved");
        return back();
    }
}
