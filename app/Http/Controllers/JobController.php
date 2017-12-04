<?php

namespace App\Http\Controllers;

use App\AssignCustomer;
use App\Customer;
use App\Department;
use App\Helper;
use App\Job;
use App\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Spatie\Permission\Traits\hasRole;
use Yajra\DataTables\DataTables;

class JobController extends Controller
{
    private static $prefixTitle = '职位';

    public function __construct()
    {
        $this->middleware('auth');
        Region::Address();
        Department::get();
    }

    /**
     * Show the customer home page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = '我的职位';
        $route_name = 'job.index';
        $type = 'my';

        return view('job.index', compact('title', 'route_name', 'type'));
    }

    /**
     * Show the all jobs.
     *
     * @return \Illuminate\Http\Response
     */
    public function all()
    {
        $title = '猎帮职位';
        $route_name = 'job.all';
        $type = 'all';

        return view('job.index', compact('title', 'route_name', 'type'));
    }

    public function add(Request $request)
    {
        $title = '新建职位';

        if ($request->isMethod('POST'))
        {
            $data = $request->input();

            $this->validate($request,
                [
                    'cid'         => Auth::user()->hasRole('admin|manager') ? 'required' : [
                        'required',
                        Rule::exists('assigncustomers')->where(function ($query)
                        {
                            $query->where('uid', Auth::id());
                        }),
                    ],
                    'name'        => [
                        'required',
                        Rule::unique('jobs')->where(function ($query) use ($data)
                        {
                            $query->where('did', $data['did']);
                        }),
                    ],
                    'requirement' => 'required',
                    'salary'      => 'required',
                ],
                [
                    'cid.required'         => '请选择:attribute.',
                    'cid.exists'           => '你无权给未分配:attribute 增加职位',
                    'name.required'        => '请输入:attribute.',
                    'name.unique'          => ':attribute 已经存在.',
                    'requirement.required' => '请输入:attribute.',
                    'salary.required'      => '请输入:attribute.',
                ],
                [
                    'cid'         => '客户',
                    'name'        => '职位名称',
                    'requirement' => '任职要求',
                    'salary'      => '薪酬结构',
                ]);
            $job = new Job();
            $job->sn = Helper::generationSN('ZW');
            $job->cid = $data['cid'];
            $job->did = $data['did'];
            $job->name = $data['name'];
            $job->requirement = $data['requirement'];
            $job->workyears = $data['workyears'];
            $job->gender = $data['gender'];
            $job->majors = $data['majors'];
            $job->degree = $data['degree'];
            $job->unified = isset($data['unified']) ? $data['unified'] : 0;
            $job->salary = $data['salary'];
            $job->creater = Auth::id();
            $job->modifier = Auth::id();
            if ($job->save())
            {
                return redirect()->back()->with('success', '创建成功！');
            }
            else
            {
                return redirect()->back()->with('error', '创建失败！');
            }
        }

        $assignedCustomers = AssignCustomer::with('customer')->where(['uid' => Auth::id(), 'show' => 1])->get(['uid', 'cid']);
        $assignedCustomers = array_pluck($assignedCustomers, 'customer');
        $assignedCustomers = array_pluck($assignedCustomers, 'name', 'id');

        $data = $request->input();
        if (isset($data['cid']))
        {
            $cid = $data['cid'];
            return view('job.add', compact('title', 'assignedCustomers', 'cid'));
        }
        return view('job.add', compact('title', 'assignedCustomers'));
    }

    public function detail(Request $request, $id)
    {
        $title = '职位信息';
        $job = Job::findOrFail($id);

        return view('job.detail', compact('title', 'job'));
    }

    public function search(Request $request, $type)
    {
        $jobs = new Collection([]);
        if ('my' == $type)
        {
            $assignCustomers = AssignCustomer::with('customer')->where(['uid' => Auth::id(), 'show' => 1])->get(['uid', 'cid']);
            foreach ($assignCustomers as $assignCustomer)
            {
                $jobs = $jobs->merge($assignCustomer->customer->jobs);
            }
        }
        if ('all' == $type)
        {
            $jobs = Job::with('customer')->with('line')->where(['show' => 1])->get(['id', 'sn', 'cid', 'name', 'workyears', 'gender', 'majors', 'degree', 'unified', 'closed', 'created_at']);
        }

        foreach ($jobs as $key => $job)
        {
            $jobs[$key]['isMine'] = $job->isMine;
        }
        return Datatables::of($jobs->sortByDesc('created_at'))->make();
    }

    public function pause(Request $request, $id)
    {
        $job = Job::findOrFail($id);
        if ($job->closed)
        {
            return json_encode(['code' => 2, 'msg' => '该职位已经暂停！']);
        }
        if ($job->pause())
        {
            return json_encode(['code' => 0, 'msg' => '操作成功！']);
        }
        return json_encode(['code' => 1, 'msg' => '操作失败！']);
    }

    public function open(Request $request, $id)
    {
        $job = Job::findOrFail($id);
        if (!$job->closed)
        {
            return json_encode(['code' => 2, 'msg' => '该职位已经发布！']);
        }
        if ($job->customer->closed)
        {
            return json_encode(['code' => 3, 'msg' => '该职位对应客户已经暂停！']);
        }
        if ($job->open())
        {
            return json_encode(['code' => 0, 'msg' => '操作成功！']);
        }
        return json_encode(['code' => 1, 'msg' => '操作失败！']);
    }
}
