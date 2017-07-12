<?php

namespace App\Http\Controllers;

use App\Region;
use App\Role;
use App\User;
use App\UserDepartment;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
        Region::Address();
    }

    public function detail(Request $request, $id)
    {
        $title = '用户中心';

        $departments = UserDepartment::where(['show' => 1])->get();
        $roles = Role::where(['show' => 1])->get();
        //dd($request->url());

        return view('user.detail', [
            'title' => $title,
            'user' => User::find($id),
            'departments' => $departments,
            'roles' => $roles,
        ]);
    }
}
