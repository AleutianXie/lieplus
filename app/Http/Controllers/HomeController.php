<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Resume;
use App\User;
use Yajra\DataTables\DataTables;

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
    public function index(Request $request)
    {
        //$resumes = Resume::where(['creater' => 2])->get();

            //return Datatables::of(User::all())->make(true);

        return view('home');
    }

    public function getuser()
    {
        $users = User::select(['id', 'name','email','created_at','updated_at']);

        return Datatables::of($users)->make();

    }

}
