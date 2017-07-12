<?php

namespace App\Http\Controllers;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class RoleController extends Controller
{
    //
    public function __construct()
    {
        //$this->middleware('auth:api', ['except' => 'login']);
        $this->middleware('auth');
    }

    public function add(Request $request)
    {
        if ($request->isMethod('POST'))
        {
            $data = $request->input();

            $validator = Validator::make($request->all(),
                [
                    'rname' => ['required', 'unique:roles,name'],
                ],
                [
                    'rname.required' => '请填写:attribute.',
                    'unique' => ':attribute 已经存在.',
                ],
                [
                    'rname' => '角色名称',
                ]);

            if ($validator->fails())
            {
                return redirect('/user/' . Auth::id() . '#settings')
                    ->withErrors($validator)
                    ->withInput();
            }

            $role = new Role();
            $role->name = trim($data['rname']);
            $role->creater = Auth::id();
            $role->modifier = Auth::id();

            if ($role->save())
            {
                return redirect('/user/' . Auth::id() . '#settings')->with('success', '创建成功！');
            }
            else
            {
                return redirect('/user/' . Auth::id() . '#settings')->with('error', '创建失败！');
            }
        }
    }
}
