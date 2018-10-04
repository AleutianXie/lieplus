<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserPost;
use App\User;
use Cici\Lieplus\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    //
    public function detail(Request $request, $id, $tab = 'index')
    {
        $departments = Branch::all();
        $roles = Role::all();
        $user = User::findOrFail($id);
        $departmentList = [];
        foreach ($departments as $department) {
            $departmentList[] = ['id' => $department->id, 'text' => $department->name];
        }
        return view('Lieplus::user.detail', compact('tab','departments', 'roles', 'user', 'departmentList'));
    }

    public function index()
    {
        $title = '用户列表';
        $users = User::orderBy('id')->paginate(10);
        //dd($request->url());

        return view('admin.user.index', compact('title', 'users'));

    }

    public function edit(StoreUserPost $request)
    {
        //var_dump($request->input());exit;

        if ($request->isMethod('POST'))
        {
            $data = $request->input();
            $id = $data['pk'];
            $user = User::find($id);

            if ($data['name'] == 'name' || $data['name'] == 'email')
            {
                $user->update([$data['name'] => $data['value']]);
            }
            else
            {
                $profile = $user->profile();
                $values = [$data['name'] => $data['value']];
                $attributes = ['updated_by' => $request->user()->id];
                if (empty($profile)) {
                    $attributes['created_by'] = $request->user()->id;
                }
                $user->profile()->updateOrCreate($attributes, $values);
            }
        }
    }

    public function addrole(Request $request)
    {
        if ($request->isMethod('POST'))
        {
            $data = $request->input();
            $user = User::find($data['user_id']);
            // dd($user);
            // dd($user->assignRole($data['role']));
            if ($user->assignRole($data['role']))
            {
                return redirect()->back()->with('success', '分配成功！');
            }
            else
            {
                return redirect()->back()->with('error', '分配失败！');
            }
        }
    }
}
