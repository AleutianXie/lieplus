<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Department;
use App\Helper;
use App\Job;
use App\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\Rule;

class JobController extends Controller {
    private static $prefixTitle = '职位';

    public function __construct() {
        $this->middleware('auth');
        Region::Address();
        Department::get();
    }

    /**
     * Show the customer home page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $title = '我的职位';
        //$jobs = Job::all();

        $jobs = Job::where(['creater' => Auth::id(), 'show' => 1])->get();

        return view('job.index', [
            'title' => $title,
            'breadcrumbs' => self::breadcrumbs(),
            'jobs' => $jobs,
        ]);
    }

    /**
     * Show the all jobs.
     *
     * @return \Illuminate\Http\Response
     */
    public function all() {
        $title = '猎帮职位';
        $jobs = Job::all();

        return view('job.index', [
            'title' => $title,
            'breadcrumbs' => self::breadcrumbs(),
            'jobs' => $jobs,
        ]);
    }

    public function add(Request $request) {
        $title = '新建职位';

        if ($request->isMethod('POST')) {
            $data = $request->input();

            $this->validate($request,
                [
                    'cid' => 'required',
                    'name' => ['required',
                        Rule::unique('jobs')->where(function ($query) use ($data) {
                            $query->where('did', $data['did']);})],
                    'requirement' => 'required',
                    'salary' => 'required',
                ],
                [
                    'cid.required' => '请选择:attribute.',
                    'name.required' => '请输入:attribute.',
                    'name.unique' => ':attribute 已经存在.',
                    'requirement.required' => '请输入:attribute.',
                    'salary.required' => '请输入:attribute.',
                ],
                [
                    'cid' => '客户',
                    'name' => '职位名称',
                    'requirement' => '任职要求',
                    'salary' => '薪酬结构',
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
            if ($job->save()) {
                return redirect()->back()->with('success', '创建成功！');
            } else {
                return redirect()->back()->with('error', '创建失败！');
            }
        }

        // Customer need update for only assigned
        $assignedCustomers = Customer::where(['creater' => 1])->get(['id', 'name']);

        $assignedCustomers = array_pluck($assignedCustomers, 'name', 'id');

        return view('job.add', [
            'title' => $title,
            'breadcrumbs' => self::breadcrumbs($title),
            'assignedCustomers' => $assignedCustomers,
        ]);
    }

    public function detail(Request $request, $id) {
        $title = '职位信息';
        $job = Job::findOrFail($id);

        return view('job.detail', [
            'title' => $title,
            'breadcrumbs' => self::breadcrumbs(),
            'job' => $job,
        ]);
    }

    private static function breadcrumbs($title = null) {
        $retValue = array();
        $url = URL::current();
        $url = trim($url, '/index');

        if (null == $title || 'http:' == dirname($url) || 'https:' == dirname($url)) {
            return [['url' => '/', 'text' => '首页'], ['url' => $url, 'text' => self::$prefixTitle]];
        }

        return [['url' => '/', 'text' => '首页'],
            ['url' => dirname($url), 'text' => self::$prefixTitle],
            ['url' => $url, 'text' => $title]];
    }
}
