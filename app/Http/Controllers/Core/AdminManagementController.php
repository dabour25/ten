<?php

namespace App\Http\Controllers\Core;

use Illuminate\Http\Request;
use App\Http\Controllers as con;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\MyAdmin;
use Session;
use View;

class AdminManagementController extends con\Controller
{
    public function __construct(){
        $this->middleware('auth:myadmin');
        $page="Admin Management";
        View::share('page',$page);
    }

    public function index($secret){
        $admins=MyAdmin::paginate('50');
        return view('myadmin/admin-management/index',compact('secret','page','admins'));
    }
    public function destroy(Request $req){
        if($req['id']!=1){
            MyAdmin::where('id',$req['id'])->delete();
        }
        return back();
    }
    public function create($secret){
        return view('myadmin/admin-management/create',compact('secret'));
    }
    public function edit($secret,$id){
        $admin=MyAdmin::where('id',$id)->first();
        return view('myadmin/admin-management/edit',compact('secret','admin'));
    }
    public function store(Request $req){
        $this->validate($req, [
            'email'   => 'required|email|unique:myadmin,email',
            'password' => 'required|min:6|regex:/[A-z]*[0-9]+[A-z]*/',
            'secret_key' =>'required|min:10|max:10|regex:/[A-z]*[0-9]+[A-z]*/',
        ]);
        $req['password']=Hash::make($req['password']);
        MyAdmin::create($req->except('password_confirmation'));
        return back();
    }
    public function update(Request $req,$secret,$id){
        $admin=MyAdmin::where('id',$id)->first();
        if(empty($admin)){
            return back();
        }
        $this->validate($req, [
            'email'   => 'required|email|unique:myadmin,email,'.$id,
            'secret_key' =>'required|min:10|max:10|regex:/[A-z]*[0-9]+[A-z]*/',
        ]);
        if(!empty($req['password'])){
            $this->validate($req, [
                'password' => 'required|min:6|regex:/[A-z]*[0-9]+[A-z]*/',
            ]);
            $req['password']=Hash::make($req['password']);
        }else{
            $req['password']=$admin->password;
        }
        MyAdmin::where('id',$id)->update($req->except(['_token','_method']));
        if($id==Auth::guard('myadmin')->user()->id){
            return redirect('/myadmin/'.$req['secret_key'].'/admin-management/'.$id.'/edit');
        }
        return back();
    }
}
