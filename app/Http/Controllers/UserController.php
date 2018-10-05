<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserPost;
use App\User;
use Cici\Lieplus\Models\Branch;
use Illuminate\Http\Request;
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
        return view('Lieplus::user.detail', compact('tab', 'departments', 'roles', 'user', 'departmentList'));
    }

    public function index(Request $request)
    {
        $filter = $request->input();
        $modal = User::query();
        $this->getModel($modal, $filter);
        $users = $modal->paginate(10)->appends($filter);

        return view('Lieplus::user.index', compact('title', 'users'));
    }

    public function edit(StoreUserPost $request)
    {
        if ($request->isMethod('POST')) {
            $data = $request->input();
            $id = $data['pk'];
            $user = User::find($id);

            if ($data['name'] == 'name' || $data['name'] == 'email') {
                $user->update([$data['name'] => $data['value']]);
            } else {
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

    public function addRole(Request $request)
    {
        if ($request->isMethod('POST')) {
            $data = $request->input();
            $user = User::find($data['user_id']);
            $user->assignRole($data['role']);
            return json_encode(['code' => 0, 'msg' => '分配成功！']);
        }
    }

    private function getModel(&$model, $filter = [])
    {
        if (!empty($filter['name'])) {
            $model->where('name', 'like', '%' . $filter['name'] . '%');
        }
        if (!empty($filter['email'])) {
            $model->where('email', 'like', '%' . $filter['email'] . '%');
        }
        if (!empty($filter['branch'])) {
            $model->where('branch', $filter['mobile']);
        }
        $model->latest();
    }
}
