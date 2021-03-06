<?php

namespace App\Http\Controllers;

use Cici\Lieplus\Models\Customer;
use Cici\Lieplus\Models\Department;
use Cici\Lieplus\Models\Job;
use Cici\Lieplus\Models\Project;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->input();
        $model = Project::query();
        $this->getModel($model, $filter);
        $projects = $model->get();
        return view('Lieplus::project.index', compact('projects', 'filter'));
    }

    public function detail(Request $request, $id)
    {
        $project = Project::findOrFail($id);
        return view('Lieplus::project.detail', compact('project'));
    }

    public function index_bak(Request $request)
    {
        if ($request->isMethod('POST')) {
            $this->validate($request, [
                'name'        => ['required', 'unique:customers'],
                'department'  => 'required',
                'province'    => 'required',
                'city'        => 'required',
                'county'      => 'required',
                'welfare'     => 'required',
                'worktime'    => 'required',
                'financing'   => 'required',
                'industry'    => 'required',
                'property'    => 'required',
                'introduce'   => 'required',
                'job_name'    => 'required',
                'requirement' => 'required',
                'salary'      => 'required',
            ], [
                'unique'          => ':attribute 已经存在.',
                'before_or_equal' => ':attribute 必须早于或等于',
                'after_or_equal'  => ':attribute 必须晚于或等于',
            ], [
                'name'       => '公司全称',
                'department' => '招聘部门',
                'province'   => '省',
                'city'       => '市',
                'county'     => '县',
                'welfare'    => '薪资福利',
            ]);

            try {
                DB::beginTransaction();
                $data = $request->input();

                // add customer
                $customer           = new Customer();
                $customer->sn       = Helper::generationSN('KH');
                $customer->name     = $data['name'];
                $customer->province = $data['province'];
                $customer->city     = $data['city'];
                $customer->county   = $data['county'];
                $customer->welfare  = $data['welfare'];
                $customer->worktime = $data['worktime'];
                if (!empty($data['founder'])) {
                    $customer->founder = $data['founder'];
                }
                $customer->financing = $data['financing'];
                $customer->industry  = $data['industry'];
                $customer->ranking   = $data['ranking'];
                $customer->property  = $data['property'];
                $customer->size      = $data['size'];
                $customer->introduce = $data['introduce'];
                $customer->creater   = Auth::id();
                $customer->modifier  = Auth::id();
                $customer->save();

                $departments      = explode(",", $data['department']);

                $job              = new Job();
                // add departments
                foreach ($departments as $value) {
                    $department           = new Department();
                    $department->cid      = $customer->id;
                    $department->name     = trim($value);
                    $department->creater  = Auth::id();
                    $department->modifier = Auth::id();
                    $department->save();

                    if ($data['job_department'] == $department->name) {
                        $job->did = $department->id;
                    }
                }

                // add job
                $job->sn          = Helper::generationSN('ZW');
                $job->name        = $data['job_name'];
                $job->requirement = $data['requirement'];
                $job->workyears   = $data['workyears'];
                $job->gender      = $data['gender'];
                $job->majors      = $data['majors'];
                $job->degree      = $data['degree'];
                $job->unified     = isset($data['unified']) ? $data['unified'] : 0;
                $job->salary      = $data['salary'];
                $job->creater     = Auth::id();
                $job->modifier    = Auth::id();
                $job->cid         = $customer->id;
                $job->save();

                // add project
                $project           = new Project();
                $project->sn       = Helper::generationSN('XM');
                $project->jid      = $job->id;
                $project->cid      = $customer->id;
                $project->creater  = Auth::id();
                $project->modifier = Auth::id();
                // add project
                $project->save();
                DB::commit();
                return json_encode(['code' => 0, 'msg' => '创建成功！', 'pid' => $project->id]);
            } catch (Exception $e) {
                DB::rollback();
                return json_encode(['code' => 1, 'msg' => '创建失败！']);
            }
        }

        $title = '项目启动书';
        return view('bd.project', compact('title'));
    }

    public function create(Request $request)
    {
        try {
            $data = $request->input();
            DB::beginTransaction();
            // add customer
            $customer_attributes = array_filter($data, function ($key) {
                return in_array($key, [
                    'name',
                    'province',
                    'city',
                    'county',
                    'welfare',
                    'work_time',
                    'founder',
                    'financing',
                    'industry',
                    'ranking',
                    'property',
                    'size',
                    'introduce',
                    'level',
                    'type',
                    'status'
                ]);
            }, ARRAY_FILTER_USE_KEY);
            $customer_attributes['created_by'] = $request->user();
            $customer_attributes['updated_by'] = $request->user();
            $customer = Customer::create($customer_attributes);

            // add departments
            $departments      = explode(",", $data['department']);
            $department_id    = '';

            foreach ($departments as $department_name) {
                $customer_id = $customer->id;
                $name = trim($department_name);
                $created_by = $request->user();
                $updated_by = $request->user();

                $department = Department::create(compact('customer_id', 'name', 'created_by', 'updated_by'));

                if (trim($data['job_department']) == $department_name) {
                    $department_id = $department->id;
                }
            }

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
            $job = Job::create($customer_attributes);

            // add project
            $job_id          = $job->id;
            $status          = 0;
            $created_by      = $request->user();
            $updated_by      = $request->user();
            Project::create(compact('job_id', 'status', 'created_by', 'updated_by'));
            DB::commit();

            return json_encode(['code' => 0, 'msg' => '创建成功！', 'pid' => $project->id]);
        } catch (Exception $e) {
            DB::rollback();
            return json_encode(['code' => 1, 'msg' => '创建失败！']);
        }
    }

    public function edit(Request $request)
    {
        $data                     = $request->input();
        $id                       = $data['pk'];
        $project                  = Project::find($id);
        $project->{$data['name']} = $data['value'];
        $project->modifier        = Auth::id();

        if (!$project->save()) {
            return '更新失败';
        }
    }


    public function reject(Request $request, $id)
    {
        $project = Project::findOrFail($id);

    }

    public function search(Request $request)
    {
        $filter = $request->input();
        $model = Project::query();
        $this->getModel($model, $filter);
        return Datatables::of($model)->make();
    }

    private function getModel(&$model, $filter = [])
    {
        if (!empty($filter['company_name'])) {
            $model->CompanyName($filter['company_name']);
        }
        if (!empty($filter['job_name'])) {
            $model->JobName($filter['job_name']);
        }
        $model->latest();
    }
}
