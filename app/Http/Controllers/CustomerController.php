<?php

namespace App\Http\Controllers;

use App\AssignCustomer;
use App\Customer;
use App\Region;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        Region::Address();

    }

    /**
     * Show the customer home page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = '我的客户';
        $users = User::role('customer')->get();
        return view('customer.index', compact('title', 'users'));
    }

    public function all()
    {
        $title = '猎加客户';
        $users = User::role('customer')->get();
        return view('customer.all', compact('title', 'users'));
    }

    public function add(Request $request)
    {
        $title = '新建客户';
        $route_name = 'customer.add';

        if ($request->isMethod('POST'))
        {
            $this->validate($request,
                [
                    'name'          => 'required',
                    'mobile'        => ['required', 'regex:/^1(3|4|5|7|8)[0-9]{9}$/', 'unique:resumes'],
                    'email'         => 'required|email|unique:resumes',
                    'birthdate'     => 'required|date|before_or_equal:' . date('Y-m-d', time()),
                    'startworkdate' => 'required|date|before_or_equal:' . date('Y-m-d', time()) . '|after_or_equal:' . date('Y-m-d', strtotime('-20 years')),
                ], [
                    'unique'          => ':attribute 已经存在.',
                    'before_or_equal' => ':attribute 必须早于或等于',
                    'after_or_equal'  => ':attribute 必须晚于或等于',
                ], [
                    'mobile'        => '手机',
                    'email'         => '邮箱',
                    'birthdate'     => '出生日期',
                    'startworkdate' => '开始工作日期',
                ]);
            $data = $request->input();

            return 2;
        }

        return view('customer.add', compact('title', 'route_name'));
    }

    public function detail(Request $request, $id)
    {
        $title = '客户信息';
        $customer = Customer::findOrFail($id);

        return view('customer.detail', compact('title', 'customer'));
    }

    public function audit(Request $request, $id)
    {
        $title = '审核客户';
        return view('customer.audit', compact('title'));
    }

    public function isExist(Request $request)
    {
        if ($request->isMethod('POST'))
        {
            $name = $request->input('name');

            $customer = Customer::where('name', $name)->get()->toArray();

            if (empty($customer))
            {
                return 'false';
            }

            return 'true';

        }
    }

    public function edit(Request $request)
    {
        $data = $request->input();
        $id = $data['pk'];

        $customer = Customer::find($id);
        $customer->{$data['name']} = $data['value'];
        $customer->modifier = Auth::id();

        if (!$customer->save())
        {
            return '更新失败';
        }
    }

    public function search(Request $request, $type)
    {
        $customers = [];
        if ('my' == $type)
        {
            $assignCustomers = AssignCustomer::with('customer')->where(['uid' => Auth::id(), 'show' => 1])->get(['uid', 'cid']);
            $customers = array_pluck($assignCustomers, 'customer');
        }
        if ('all' == $type)
        {
            $customers = Customer::with('jobs')->with('project')->where(['show' => 1])->get(['id', 'sn', 'name', 'industry', 'level', 'property']);
        }
        $cids = AssignCustomer::where(['uid' => Auth::id(), 'show' => 1])->get(['cid']);
        $cids = array_pluck($cids, 'cid');

        foreach ($customers as $key => $customer)
        {
            $customers[$key] = $customer->with('jobs')->with('project')->with('assigned')->where(['id' => $customer->id])->first(['id', 'sn', 'name', 'industry', 'level', 'property', 'closed']);
            $customers[$key]['jobCount'] = count($customer->jobs);
            $customers[$key]['openCount'] = count($customer->jobs->where('closed', 0));
            $customers[$key]['closedCount'] = count($customer->jobs->where('closed', 1));
            $customers[$key]['ismine'] = in_array($customer->id, $cids);
        }
        return Datatables::of($customers)->make();
    }

    public function pause(Request $request, $id)
    {
        $user = Auth::user();

        if (!$user->hasRole('admin') && !$user->hasRole('manager') && !$user->hasRole('customer'))
        {
            return json_encode(['code' => 3, 'msg' => '您没有权限暂停该客户！']);
        }
        $customer = Customer::with('jobs')->findOrFail($id);
        $cids = AssignCustomer::where(['uid' => Auth::id(), 'show' => 1])->get(['cid']);
        $cids = array_pluck($cids, 'cid');
        if ($user->hasRole('customer') && !in_array($customer->id, $cids))
        {
            return json_encode(['code' => 3, 'msg' => '您没有权限暂停该客户！']);
        }
        if ($customer->closed)
        {
            return json_encode(['code' => 2, 'msg' => '该客户已经暂停！']);
        }
        if ($customer->pause())
        {
            foreach ($customer->jobs as $job)
            {
                $job->closed = 1;
                if (!$job->save())
                {
                    return json_encode(['code' => 3, 'msg' => '客户暂停成功，但对应的某职位暂停失败，请手动去暂停！']);
                }
            }
            return json_encode(['code' => 0, 'msg' => '操作成功！']);
        }
        return json_encode(['code' => 1, 'msg' => '操作失败！']);
    }

    public function open(Request $request, $id)
    {
        $user = Auth::user();

        if (!$user->hasRole('admin') && !$user->hasRole('manager') && !$user->hasRole('customer'))
        {
            return json_encode(['code' => 3, 'msg' => '您没有权限启动/重新启动与该客户的合作！']);
        }
        $customer = Customer::findOrFail($id);
        if (!$customer->closed)
        {
            return json_encode(['code' => 2, 'msg' => '该客户已经在合作！']);
        }
        if ($customer->open())
        {
            return json_encode(['code' => 0, 'msg' => '操作成功！']);
        }
        return json_encode(['code' => 1, 'msg' => '操作失败！']);
    }

    public function assign(Request $request)
    {
        $user = Auth::user();

        if (!$user->hasRole('admin') && !$user->hasRole('manager'))
        {
            return json_encode(['code' => 3, 'msg' => '您没有权限分配客户顾问！']);
        }
        $this->validate($request, [
            'cid' => 'required',
            'uid' => 'required',
        ], [
            'uid.required' => '请选择:attribute.',
        ], [
            'cid' => '客户',
            'uid' => '客户顾问',
        ]);
        $data = $request->input();
        $cid = $data['cid'];
        $uid = $data['uid'];
        $assignCustomer = AssignCustomer::where(['cid' => $cid, 'uid' => $uid])->first();
        if (!empty($assignCustomer))
        {
            return json_encode(['code' => 1, 'msg' => '该客户顾问已经分配过该职位！']);
        }
        $assignCustomer = new AssignCustomer();
        $assignCustomer->cid = $cid;
        $assignCustomer->uid = $uid;
        $assignCustomer->creater = Auth::id();
        $assignCustomer->modifier = Auth::id();
        if ($assignCustomer->save())
        {
            return json_encode(['code' => 0, 'msg' => '操作成功！']);
        }
        return json_encode(['code' => 2, 'msg' => '操作失败！']);
    }

    public function assignmodal(Request $request, $aid = null)
    {
        $users = User::role('customer')->get();

        return view('customer.assign', compact('aid', 'users'));
    }
}
