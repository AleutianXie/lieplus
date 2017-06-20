<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class CustomerController extends Controller
{
    private static $prefixTitle = '客户';

    public function __construct()
    {
        //$this->middleware('auth:api', ['except' => 'login']);
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
        $title = '客户列表';
        $customers = Customer::all();

        return view('customer.index', [
            'title' => $title,
            'breadcrumbs' => self::breadcrumbs(),
            'customers' => $customers,
        ]);
    }

    public function add(Request $request)
    {
        $title = '新建客户';

        if ($request->isMethod('POST'))
        {
            $this->validate($request,
                [
                    'name' => 'required',
                    'mobile' => ['required', 'regex:/^1(3|4|5|7|8)[0-9]{9}$/', 'unique:resumes'],
                    'email' => 'required|email|unique:resumes',
                    'birthdate' => 'required|date|before_or_equal:' . date('Y-m-d', time()),
                    'startworkdate' => 'required|date|before_or_equal:' . date('Y-m-d', time()) . '|after_or_equal:' . date('Y-m-d', strtotime('-20 years')),
                ], [
                    'unique' => ':attribute 已经存在.',
                    'before_or_equal' => ':attribute 必须早于或等于',
                    'after_or_equal' => ':attribute 必须晚于或等于',
                ], [
                    'mobile' => '手机',
                    'email' => '邮箱',
                    'birthdate' => '出生日期',
                    'startworkdate' => '开始工作日期',
                ]);
            $data = $request->input();

            return 2;
            //$customer = new Customer();

            // $resume->sn = 'JL'.date('Ymdhis', time()).sprintf('%4d', mt_rand(0, 9999));
            // $resume->name = $data['name'];
            // $resume->gender = $data['gender'];
            // $resume->mobile = $data['mobile'];
            // $resume->email = $data['email'];
            // $resume->degree = $data['degree'];
            // $resume->province = $data['province'];
            // $resume->city = $data['city'];
            // $resume->county = $data['county'];
            // $resume->birthdate = $data['birthdate'];
            // $resume->startworkdate = $data['startworkdate'];
            // $resume->industry = $data['industry'];
            // $resume->position = $data['position'];
            // $resume->salary = $data['salary'];
            // $resume->others = $data['others'];
            // $resume->creater = Auth::id();
            // $resume->modifier = Auth::id();

            // if ($resume->save()) {
            //     //dd($resume);
            //     $library = new Library();
            //     $library->uid = Auth::id();
            //     $library->rid = $resume->id;
            //     $library->type = 1;
            //     $library->creater = Auth::id();

            //     $library->save();

            //     return redirect('/resume/'.$resume->id);
            // } else {
            //     return redirect()->back();
            // }
        }

        return view('customer.add', [
            'title' => $title,
            'breadcrumbs' => self::breadcrumbs($title),
        ]);
    }

    public function detail(Request $request, $id)
    {
        $title = '客户信息';
        $customer = Customer::findOrFail($id);

        return view('customer.detail', [
            'title' => $title,
            'breadcrumbs' => self::breadcrumbs(),
            'customer' => $customer,
        ]);
    }

    public function audit(Request $request, $id)
    {
        $title = '审核客户';
        return view('customer.audit', [
            'title' => $title,
            'breadcrumbs' => self::breadcrumbs(),
        ]);
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

        $resume = Customer::find($id);
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

    private static function breadcrumbs($title = null)
    {
        $retValue = array();
        $url = URL::current();
        $url = trim($url, '/index');

        if (null == $title || 'http:' == dirname($url) || 'https:' == dirname($url))
        {
            return [['url' => '/', 'text' => '首页'], ['url' => $url, 'text' => self::$prefixTitle]];
        }

        return [['url' => '/', 'text' => '首页'],
            ['url' => dirname($url), 'text' => self::$prefixTitle],
            ['url' => $url, 'text' => $title]];
    }
}
