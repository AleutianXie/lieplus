<?php

namespace App\Http\Controllers;

//use App\Region;
use App\Profile;
use App\User;
use App\UserDepartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Validator;

class UserController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
        $this->attributes = [
            'name' => __('auth.name'),
            'email' => __('auth.email'),
            'number' => __('lieplus.number'),
            'mobile' => __('lieplus.mobile'),
            'birthdate' => __('lieplus.birthdate'),
            'did' => __('lieplus.departments'),
            'role_id' => __('lieplus.role'),
        ];

        $this->validationRules = [
            'name' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'mobile' => ['required', 'regex:/^1(3|4|5|7|8)[0-9]{9}$/', 'unique:profiles'],
            'number' => ['required', 'regex:/^(H|h)[0-9]{4}$/', 'unique:profiles'],
            'birthdate' => 'required|date|before_or_equal:' . date('Y-m-d', time()),
            'did' => 'required|integer',
            'role_id' => 'required|integer',
        ];
        //Region::Address();
    }

    private $validationRules;
    private $attributes;

    public function detail(Request $request, $id)
    {
        $title = '用户中心';

        $departments = UserDepartment::where(['show' => 1])->get();
        $roles = Role::all();
        $user = User::find($id);
        //dd($request->url());
        $departmentList = [];
        foreach ($departments as $department)
        {
            $departmentList[] = ['id' => $department->id, 'text' => $department->name];
        }
        return view('user.detail', compact('title', 'departments', 'roles', 'user', 'departmentList'));
    }

    public function index()
    {
        $title = '用户列表';
        $users = User::orderBy('id')->paginate(10);
        //dd($request->url());

        return view('admin.user.index', compact('title', 'users'));

    }

    public function edit(Request $request)
    {
        //var_dump($request->input());exit;

        if ($request->isMethod('POST'))
        {
            $data = $request->input();
            $id = $data['pk'];
            $user = User::find($id);

            $rules = array_where($this->validationRules, function ($value, $key) use ($data)
            {
                return $key == $data['name'];
            });

            Validator::validate(
                [$data['name'] => $data['value']],
                $rules,
                [],
                $this->attributes
            );

            if ($data['name'] == 'name' || $data['name'] == 'email')
            {
                $user->{$data['name']} = $data['value'];

                if (!$user->save())
                {
                    return '更新失败';
                }
            }
            else
            {
                $profile = Profile::where(['uid' => $id])->first();
                if ($profile == null)
                {
                    $profile = new Profile();
                    $profile->uid = $id;
                    $profile->creater = Auth::id();
                }
                $profile->{$data['name']} = $data['value'];
                $profile->modifier = Auth::id();

                if (!$profile->save())
                {
                    return '更新失败';
                }
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
