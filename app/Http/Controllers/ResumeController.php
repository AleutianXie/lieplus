<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Alert;
use App\Feedback;
use App\Library;
use App\Resume;
use App\User;
use App\Region;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class ResumeController extends Controller
{
    private static $prefixTitle = '简历';

    public function __construct(){
        //$this->middleware('auth:api', ['except' => 'login']);
        $this->middleware('auth');
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
        return view('resume.index', [
            'title' => self::$prefixTitle,
            'breadcrumbs' => self::breadcrumbs()
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

        if ($request->isMethod('POST')) {

            $this->validate($request,
                [
                'name' => 'required',
                'mobile' => ['required', 'regex:/^1(3|4|5|7|8)[0-9]{9}$/', 'unique:resumes'],
                'email' => 'required|email|unique:resumes',
                'birthdate' => 'required|date|before_or_equal:'.date('Y-m-d', time()),
                'startworkdate' => 'required|date|before_or_equal:'.date('Y-m-d', time()).'|after_or_equal:'.date('Y-m-d', strtotime('-20 years'))
                ], [
                'unique' => ':attribute 已经存在.',
                'before_or_equal' => ':attribute 必须早于或等于',
                'after_or_equal' => ':attribute 必须晚于或等于'
                ], [
                'mobile' => '手机',
                'email' => '邮箱',
                'birthdate' => '出生日期',
                'startworkdate' => '开始工作日期'
                ]);

            $data = $request->input();
            $resume = new Resume();

            $resume->sn = 'JL'.date('Ymdhis', time()).sprintf('%4d', mt_rand(0, 9999));
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

            if ($resume->save()) {
                //dd($resume);
                $library = new Library();
                $library->uid = Auth::id();
                $library->rid = $resume->id;
                $library->type = 1;
                $library->creater = Auth::id();

                $library->save();

                return redirect('/resume/'.$resume->id);
            } else {
                return redirect()->back();
            }
        }

        $provinces = Region::getProvinces();
        $cities = Region::getCities();
        $counties = Region::getCounties();

        return view('resume.add',[
            'title' => $title,
            'breadcrumbs' => self::breadcrumbs($title),
            'provinces' => $provinces,
            'cities' => $cities,
            'counties' => $counties,
            ]);
    }

    public function detail(Request $request, $id)
    {
        $title = '简历详情';
        $resume = Resume::findOrFail($id);
        //$feedbacks_obj = Feedback::where(['rid' => $id, 'show' => 1])->orderBy('created_at', 'desc')->get(['text', 'creater', 'created_at']);
        $feedbacks_obj = $resume->getFeedbacks()->where(['rid' => $id, 'show' => 1])->orderBy('created_at', 'desc')->get(['text', 'creater', 'created_at']);
        $feedbacks = array();

        foreach ($feedbacks_obj as $fitem) {
            $keys = explode(' ', $fitem->created_at);

            $date = $keys[0];
            if ($keys[0] == date("Y-m-d"))
                $date = '今天';
            else if ($keys[0] == date("Y-m-d",strtotime("-1 day")) ) {
                $date = '昨天';
            }

            $feedbacks[$date][] = array(
                'text' => $fitem->text,
                'creater' => User::find($resume->creater)->name,
                'ctime' => $keys[1]);
        }

        $resumes = Resume::where(['creater' => Auth::id()])->get();
        $provinces = Region::getProvinces();
        $cities = Region::getCities();
        $counties = Region::getCounties();

        $alerts = Alert::where(['rid' => $resume->id])->get();

        return view('resume.detail', [
            'title' => $title,
            'breadcrumbs' => self::breadcrumbs($title),
            'resume' => $resume,
            'feedbacks' => $feedbacks,
            'creater' => User::find($resume->creater)->name,
            'resumes' => $resumes,
            'alerts' => $alerts,
            'provinces' => $provinces,
            'cities' => $cities,
            'counties' => $counties,
            ]);
    }

    public function edit(Request $request)
    {
        $data = $request->input();
        $id = $data['pk'];

        $resume = Resume::find($id);
        $resume->$data['name'] = $data['value'];
        $resume->modifier = Auth::id();

        if ($resume->save()) {
            //redirect(url('/resume'));
        } else {
            //redirect()->back();
            return '更新失败';
        }
    }

    public function mylibrary()
    {

        $title = '我的简历库';

        $rids = Library::where(['uid' => Auth::id(), 'type' => 1])->get(['rid'])->toArray();

        $resumes = Resume::whereIn('id', $rids)->get();

        return view('resume.library', [
            'title' => $title,
            'breadcrumbs' => self::breadcrumbs($title),
            'resumes' => $resumes,
        ]);
    }

    public function all()
    {
        $title = '猎加简历';

        $resumes = Resume::all();

        return view('resume.library', [
            'title' => $title,
            'breadcrumbs' => self::breadcrumbs($title),
            'resumes' => $resumes,
        ]);
    }

    private static function breadcrumbs($title = null)
    {
        $retValue = array();
        $url = URL::current();
        $url = trim($url, '/index');

        if (null == $title || 'http:' == dirname($url) || 'https:' == dirname($url)) {
            return [['url' => '/', 'text' => '首页'],['url' => $url, 'text' => self::$prefixTitle]];
        }

        return [['url' => '/', 'text' => '首页'],
                ['url' => dirname($url), 'text' => self::$prefixTitle],
                ['url' => $url, 'text' => $title]];
    }
}
