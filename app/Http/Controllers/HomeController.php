<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
//DB Connect
use App\Models\Ui\Master;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
		$this->middleware('Locate', ['only' => ['en','ar','de','fr']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        $master=Master::all();
        return view('welcome',compact('master'));
    }
	public function lang($lang){
        Session::put('lang', $lang);
        return redirect('/');
    }
}
