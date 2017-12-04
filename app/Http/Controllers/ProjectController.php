<?php

namespace App\Http\Controllers;
use App\Customer;
use App\Department;
use App\Helper;
use App\Job;
use App\Project;
use App\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class ProjectController extends Controller
{
    //
    public function __construct()
    {
        //$this->middleware('auth:api', ['except' => 'login']);
        $this->middleware('auth');
        Region::Address();
    }

    public function index(Request $request)
    {
        if ($request->isMethod('POST'))
        {

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

            $data = $request->input();

            $customer = new Customer();
            $customer->sn = Helper::generationSN('KH');
            $customer->name = $data['name'];
            $customer->province = $data['province'];
            $customer->city = $data['city'];
            $customer->county = $data['county'];
            $customer->welfare = $data['welfare'];
            $customer->worktime = $data['worktime'];
            if (!empty($data['founder']))
            {
                $customer->founder = $data['founder'];
            }
            $customer->financing = $data['financing'];
            $customer->industry = $data['industry'];
            $customer->ranking = $data['ranking'];
            $customer->property = $data['property'];
            $customer->size = $data['size'];
            $customer->introduce = $data['introduce'];
            $customer->creater = Auth::id();
            $customer->modifier = Auth::id();

            $job = new Job();
            $job->sn = Helper::generationSN('ZW');
            $job->name = $data['job_name'];
            $job->requirement = $data['requirement'];
            $job->workyears = $data['workyears'];
            $job->gender = $data['gender'];
            $job->majors = $data['majors'];
            $job->degree = $data['degree'];
            $job->unified = isset($data['unified']) ? $data['unified'] : 0;
            $job->salary = $data['salary'];
            $job->creater = Auth::id();
            $job->modifier = Auth::id();

            if ($customer->save())
            {
                $job->cid = $customer->id;

                $departments = explode(",", $data['department']);

                foreach ($departments as $value)
                {
                    $department = new Department();
                    $department->cid = $customer->id;
                    $department->name = trim($value);
                    $department->creater = Auth::id();
                    $department->modifier = Auth::id();
                    $department->save();

                    if ($data['job_department'] == $department->name)
                    {
                        $job->did = $department->id;
                    }
                }

                if ($job->save())
                {
                    $project = new Project();

                    $project->sn = Helper::generationSN('XM');
                    $project->jid = $job->id;
                    $project->cid = $customer->id;
                    $project->creater = Auth::id();
                    $project->modifier = Auth::id();
                    if ($project->save())
                    {
                        return $project->id;
                    }
                    return 0;
                }
            }
        }

        $title = '项目启动书';
        return view('bd.project', compact('title'));
    }

    public function edit(Request $request)
    {
        $data = $request->input();
        $id = $data['pk'];
        $project = Project::find($id);
        $project->{$data['name']} = $data['value'];
        $project->modifier = Auth::id();

        if (!$project->save())
        {
            return '更新失败';
        }
    }

    public function audit(Request $request)
    {
        $title = '项目启动书审核';
        $projects = Project::latest()->get();

        return view('bd.audit', compact('title', 'projects'));
    }

    public function detail(Request $request, $id)
    {
        $title = '项目启动书详情';
        $project = Project::findOrFail($id);

        return view('bd.detail', compact('title', 'project'));
    }

    public function search(Request $request, $type)
    {
        if ('all' == $type)
        {
            $projects = Project::with('job')->with('company')->where(['show' => 1])->orderBy('status')->get(['id', 'sn', 'jid', 'cid', 'status']);
        }
        return Datatables::of($projects)->make();
    }
}
