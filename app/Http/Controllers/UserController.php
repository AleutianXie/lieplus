<?php

namespace App\Http\Controllers;

use App\Region;
use App\User;
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

        return view('user.detail', [
            'title' => $title,
            'user' => User::find($id),
        ]);
    }
}
