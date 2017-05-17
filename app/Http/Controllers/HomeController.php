<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Resume;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resumes = Resume::where(['creater' => 2])->get();
;
        return view('home', ['name' => 'LiePlus', 'resumes' => $resumes]);
    }
}
