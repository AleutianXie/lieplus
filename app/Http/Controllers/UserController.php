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
        $branches = Branch::all();
        $roles = Role::all();
        $user = User::findOrFail($id);
        return view('Lieplus::user.detail', compact('tab', 'branches', 'roles', 'user'));
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
                $attributes = [$data['name'] => $data['value']];
                $attributes['updated_by'] = $request->user()->id;
                if (empty($user->profile)) {
                    $attributes['created_by'] = $request->user()->id;
                    $user->profile()->create($attributes);
                } else {
                    $user->profile()->update($attributes);
                }
                return redirect()->back()->with('success', '编辑成功！');
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

    public function addBranch(StoreUserPost $request)
    {
        if ($request->isMethod('POST'))
        {
            $data = $request->input();
            $data['created_by'] = $request->user()->id;
            $data['updated_by'] = $request->user()->id;
            Branch::create($data);
            return redirect()->back()->with('success', '新建成功！');
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
