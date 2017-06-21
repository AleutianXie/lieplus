<?php

namespace App\Http\Controllers;

use App\Helper;
use App\JobLibrary;
use App\MyLibrary;
use App\Region;
use App\Resume;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResumeController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth:api', ['except' => 'login']);
        $this->middleware('auth');
        Region::Address();
    }

    /**
     * Show the resume home page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dd(URL::full());
        //dd(URL::previous());
        //Region::Address();
        //dd(config('lieplus'));
        return view('resume.index', [
            'title' => '简历',
        ]);
    }

    /**
     * Show the create resume page.
     *
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
        $title = '新建简历';

        if ($request->isMethod('POST'))
        {

            $this->validate($request, [
                'name' => 'required',
                'gender' => 'required',
                'mobile' => ['required', 'regex:/^1(3|4|5|7|8)[0-9]{9}$/', 'unique:resumes'],
                'email' => 'required|email|unique:resumes',
                'birthdate' => 'required|date|before_or_equal:' . date('Y-m-d', time()),
                'startworkdate' => 'required|date|before_or_equal:' . date('Y-m-d', time()) . '|after_or_equal:' . date('Y-m-d', strtotime('-20 years')),
            ], [
                'gender.required' => '请选择:attribute.',
                'unique' => ':attribute 已经存在.',
                'before_or_equal' => ':attribute 必须早于或等于',
                'after_or_equal' => ':attribute 必须晚于或等于',
            ], [
                'gender' => '性别',
                'mobile' => '手机',
                'email' => '邮箱',
                'birthdate' => '出生日期',
                'startworkdate' => '开始工作日期',
            ]);

            $data = $request->input();
            $resume = new Resume();

            $resume->sn = Helper::generationSN('JL');
            $resume->name = $data['name'];
            $resume->gender = $data['gender'];
            $resume->mobile = $data['mobile'];
            $resume->email = $data['email'];
            $resume->degree = $data['degree'];
            $resume->province = $data['province'];
            $resume->city = $data['city'];
            $resume->county = $data['county'];
            $resume->birthdate = $data['birthdate'];
            $resume->startworkdate = $data['startworkdate'];
            $resume->industry = $data['industry'];
            $resume->position = $data['position'];
            $resume->salary = $data['salary'];
            $resume->others = $data['others'];
            $resume->creater = Auth::id();
            $resume->modifier = Auth::id();

            if ($resume->save())
            {
                //dd($resume);
                $library = new MyLibrary();
                $library->uid = Auth::id();
                $library->rid = $resume->id;
                $library->type = 1;
                $library->creater = Auth::id();

                $library->save();

                return redirect('/resume/' . $resume->id);
            }
            else
            {
                return redirect()->back();
            }
        }

        return view('resume.add', [
            'title' => $title,
        ]);
    }

    public function detail(Request $request, $id)
    {
        $title = '简历详情';
        $resume = Resume::findOrFail($id);

        $feedbacks_obj = $resume->getFeedbacks()->where(['rid' => $id, 'show' => 1])->orderBy('created_at', 'desc')->get(['text', 'creater', 'created_at']);
        $feedbacks = array();

        foreach ($feedbacks_obj as $fitem)
        {
            $keys = explode(' ', $fitem->created_at);

            $date = $keys[0];
            if ($keys[0] == date("Y-m-d"))
            {
                $date = '今天';
            }
            else if ($keys[0] == date("Y-m-d", strtotime("-1 day")))
            {
                $date = '昨天';
            }

            $feedbacks[$date][] = array(
                'text' => $fitem->text,
                'creater' => User::find($resume->creater)->name,
                'ctime' => $keys[1]);
        }

        return view('resume.detail', [
            'title' => $title,
            'resume' => $resume,
            'feedbacks' => $feedbacks,
        ]);
    }

    public function edit(Request $request)
    {
        $data = $request->input();
        $id = $data['pk'];
        $resume = Resume::find($id);
        $resume->$data['name'] = $data['value'];
        $resume->modifier = Auth::id();

        if ($resume->save())
        {
            //redirect(url('/resume'));
        }
        else
        {
            //redirect()->back();
            return '更新失败';
        }
    }

    public function mylibrary()
    {
        $title = '我的简历库';

        $resumes = array_pluck(MyLibrary::where(['uid' => Auth::id(), 'show' => 1])->get(), 'getResume');

        return view('resume.my', [
            'title' => $title,
            'resumes' => $resumes,
        ]);
    }

    public function joblibrary()
    {
        $title = '我的职位简历库';

        $resumes = array_pluck(JobLibrary::where(['uid' => Auth::id(), 'show' => 1])->get(), 'getResume');

        return view('resume.job', [
            'title' => $title,
            'resumes' => $resumes,
        ]);
    }

    public function all()
    {
        $title = '猎加简历';
        $resumes = Resume::all();

        return view('resume.all', compact('title', 'resumes'));
    }
}
