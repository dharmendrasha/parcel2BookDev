<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

       $allTheuserInfo = DB::table('users')->select('*')->join('userprofile', 'userprofile.awb', '=', 'users.uniqNum')->join('userinfocontact', 'userinfocontact.awb','=','users.uniqNum')->join('userpickupanddrop', 'userpickupanddrop.awb','=','users.uniqNum')->join('parcelbook', 'parcelbook.awbNumber', '=', 'users.uniqNum')->where(['users.uniqNum' => \Auth::user()->uniqNum])->get();
        return view('home',\compact('allTheuserInfo'));



    }
}
