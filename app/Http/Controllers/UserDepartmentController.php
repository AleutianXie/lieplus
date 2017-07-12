<?php

namespace App\Http\Controllers;

use App\UserDepartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class UserDepartmentController extends Controller
{
    //
    public function __construct()
    {
        //$this->middleware('auth:api', ['except' => 'login']);
        $this->middleware('auth');
        Region::Address();
    }

    public function add(Request $request)
    {
        if ($request->isMethod('POST'))
        {
            $data = $request->input();

            $validator = Validator::make($request->all(),
                [
                    'number' => ['required', 'unique:userdepartments,number', 'regex:/^(B|b)(U|u)[0-9]{3}$/'],
                    'dname' => ['required', 'unique:userdepartments,name'],
                ],
                [
                    'number.required' => '请填写:attribute.',
                    'number.regex' => ':attribute 格式不对(格式:BU***)',
                    'dname.required' => '请填写:attribute.',
                    'unique' => ':attribute 已经存在.',
                ],
                [
                    'number' => '部门编码',
                    'dname' => '部门名称',
                ]);

            if ($validator->fails())
            {
                return redirect('/user/' . Auth::id() . '#settings')
                    ->withErrors($validator)
                    ->withInput();
            }

            $department = new UserDepartment();
            $department->number = strtoupper(trim($data['number']));
            $department->name = trim($data['dname']);
            $department->creater = Auth::id();
            $department->modifier = Auth::id();
            if (trim($data['description']))
            {
                $department->description = $data['description'];
            }
            if ($department->save())
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
