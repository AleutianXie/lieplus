<?php

namespace App\Http\Controllers;

use Cici\Lieplus\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Spatie\Permission\Traits\hasRole;
use Yajra\DataTables\Facades\Datatables;

class JobController extends Controller
{
    /**
     * Show the customer home page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter = $request->input();
        return view('Lieplus::job.index', compact('filter'));
    }

    /**
     * Show the all jobs.
     *
     * @return \Illuminate\Http\Response
     */
    public function all(Request $request)
    {
        $filter = $request->input();
        return view('Lieplus::job.all', compact('filter'));
    }

    public function add(Request $request)
    {
        if ($request->isMethod('POST'))
        {
            $data = $request->input();
            // $uid = Auth::id();
            // $this->validate($request,
            //     [
            //         'cid'         => Auth::user()->hasRole('admin|manager') ? 'required' : [
            //             'required',
            //             Rule::exists('assigncustomers')->where(function ($query) use ($uid)
            //             {
            //                 $query->where('uid', $uid);
            //             }),
            //         ],
            //         'name'        => [
            //             'required',
            //             Rule::unique('jobs')->where(function ($query) use ($data)
            //             {
            //                 $query->where('did', $data['did']);
            //             }),
            //         ],
            //         'requirement' => 'required',
            //         'salary'      => 'required',
            //     ],
            //     [
            //         'cid.required'         => '请选择:attribute.',
            //         'cid.exists'           => '你无权给未分配:attribute 增加职位',
            //         'name.required'        => '请输入:attribute.',
            //         'name.unique'          => ':attribute 已经存在.',
            //         'requirement.required' => '请输入:attribute.',
            //         'salary.required'      => '请输入:attribute.',
            //     ],
            //     [
            //         'cid'         => '客户',
            //         'name'        => '职位名称',
            //         'requirement' => '任职要求',
            //         'salary'      => '薪酬结构',
            //     ]);

            //         $department_id   = $attributes['department_id'];
        

            // add job
            $job_attributes = array_filter($data, function ($key) {
                return in_array($key, [
                    'department_id',
                    'name',
                    'requirement',
                    'work_years',
                    'gender',
                    'majors',
                    'degree',
                    'unified',
                    'salary',
                    'property',
                    'closed',
                    'created_by',
                    'updated_by',
                ]);
            }, ARRAY_FILTER_USE_KEY);
            $job_attributes['created_by'] = $request->user();
            $job_attributes['updated_by'] = $request->user();
            Job::create($customer_attributes);
            // $job = new Job();
            // $job->sn = Helper::generationSN('ZW');
            // $job->cid = $data['cid'];
            // $job->did = $data['did'];
            // $job->name = $data['name'];
            // $job->requirement = $data['requirement'];
            // $job->workyears = $data['workyears'];
            // $job->gender = $data['gender'];
            // $job->majors = $data['majors'];
            // $job->degree = $data['degree'];
            // $job->unified = isset($data['unified']) ? $data['unified'] : 0;
            // $job->salary = $data['salary'];
            // $job->creater = Auth::id();
            // $job->modifier = Auth::id();
            // if ($job->save())
            // {
            //     return redirect()->back()->with('success', '创建成功！');
            // }
            // else
            // {
            //     return redirect()->back()->with('error', '创建失败！');
            // }
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
        $job = Job::findOrFail($id);
        dd($job, $job->is_mine, $job->department->customer->adviser);

        return view('Lieplus::job.detail', compact('job'));
    }

    public function search(Request $request)
    {
        $filter = $request->input();
        if (!empty($filter['t']) && $filter['t'] == 'my') {
            $model = $request->user()->jobs()->getQuery();
        } else {
            $model = Job::query();
        }
        $this->getModel($model, $filter);
        return Datatables::eloquent($model)->make(true);
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

    private function getModel(&$model, $filter = [])
    {
        if (!empty($filter['customer'])) {
            $model->whereHas('department', function ($query) use ($filter) {
                $query->whereHas('customer', function ($query) use ($filter) {
                    $query->where('name', 'like', '%'.$filter['customer']);
                });
            });
        }
        if (!empty($filter['name'])) {
            $model->where('name', 'like', '%'.$filter['name'].'%');
        }
        if (!empty($filter['work_years'])) {
            $model->where('work_years', $filter['work_years']);
        }
        if (!empty($filter['gender'])) {
            $model->where('gender', $filter['gender']);
        }
        if (!empty($filter['majors'])) {
            $model->where('majors', $filter['majors']);
        }
        if (!empty($filter['degree'])) {
            $model->where('degree', $filter['degree']);
        }
        if (!empty($filter['unified'])) {
            $model->where('unified', $filter['unified']);
        }
        $model->with([
            'department' => function ($query) {
                $query->with([
                    'customer' => function ($query) {
                        $query->select(['id', 'name']);
                    }])
                ->select(['id', 'customer_id']);
            }
        ]);
        $model->select('jobs.*');
        $model->latest('jobs.created_at');
    }
}
