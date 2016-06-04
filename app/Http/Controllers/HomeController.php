<?php

namespace App\Http\Controllers;

use DingTalk\Api\Auth;
use DingTalk\Api\Department;

class HomeController extends Controller
{
    protected $token;
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
        $this->token    = Auth::getAccessToken();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $depts  = Department::listDept($this->token);
        dd($depts);
        return view('home');
    }
}
