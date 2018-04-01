<?php

namespace App\Http\Controllers;

use App\AssignLine;
use App\Helper;
use App\Http\Requests\StoreResumePost;
use App\JobLibrary;
use App\Line;
use App\MyLibrary;
// use App\Region;
use App\Resume;
use App\Station;
use App\User;
use Cici\Lieplus\Models\Region;
use Cici\Lieplus\Models\Resume as CiciResume;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class ResumeController extends Controller
{
    /**
     * Show the resume home page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Lieplus::resume.index');
    }

    /**
     * Show the create resume page.
     *
     * @return \Illuminate\Http\Response
     */
    public function add(StoreResumePost $request)
    {
        $title = '新建简历';

        //$region = Region::getInstance();
        //dd($region->getProvinces(), $region->getCities('350000'), $region->getCounties('350800'));
        if ($request->isMethod('POST')) {
            //dd($request->input());
//dd($request->input());
            $data = $request->input();
            $data['created_by'] = Auth::id();
            $data['updated_by'] = Auth::id();
            dd(CiciResume::create($data));
        }
        // if ($request->isMethod('POST')) {
        //     try {
        //         DB::beginTransaction();
        //         $data = $request->input();
        //         // save resume
        //         $resume                = new Resume();
        //         $resume->sn            = Helper::generationSN('JL');
        //         $resume->name          = $data['name'];
        //         $resume->gender        = $data['gender'];
        //         $resume->mobile        = $data['mobile'];
        //         $resume->email         = $data['email'];
        //         $resume->degree        = $data['degree'];
        //         $resume->province      = $data['province'];
        //         $resume->city          = $data['city'];
        //         $resume->county        = $data['county'];
        //         $resume->birthdate     = $data['birthdate'];
        //         $resume->startworkdate = $data['startworkdate'];
        //         $resume->industry      = $data['industry'];
        //         $resume->position      = $data['position'];
        //         $resume->salary        = $data['salary'];
        //         $resume->others        = $data['others'];
        //         $resume->creater       = Auth::id();
        //         $resume->modifier      = Auth::id();
        //         $resume->save();

        //         // add my library
        //         $mylibrary = new MyLibrary();
        //         $mylibrary->uid = Auth::id();
        //         $mylibrary->rid = $resume->id;
        //         $mylibrary->creater = Auth::id();
        //         $mylibrary->save();

        //         // add job library
        //         if (isset($data['jid']) && !empty($data['jid'])) {
        //             $joblibrary          = new JobLibrary();
        //             $joblibrary->uid     = Auth::id();
        //             $joblibrary->rid     = $resume->id;
        //             $joblibrary->jid     = $data['jid'];
        //             $joblibrary->creater = Auth::id();
        //             $joblibrary->save();
        //             // add to station
        //             $station             = new Station();
        //             $station->sn         = Helper::generationSN('GZT');
        //             $station->lid        = $joblibrary->line->id;
        //             $station->rid        = $resume->id;
        //             $station->status     = 1;
        //             $station->creater    = Auth::id();
        //             $station->modifier   = Auth::id();
        //             $station->save();
        //         }

        //         DB::commit();
        //         return redirect('/resume/' . $resume->id);
        //     } catch (Exception $e) {
        //         DB::rollBack();
        //         return redirect()->back()->with('error', '创建失败！（网络原因）');
        //     }
        // }

        // $assignlines = AssignLine::where(['uid' => Auth::id(), 'show' => 1])->get();

        // return view('resume.add', [
        //     'title'       => $title,
        //     'assignlines' => $assignlines,
        //     'jid'         => isset($request->input()['jid']) ? $request->input()['jid'] : 0,
        // ]);
        return view('Lieplus::resume.create');
    }

    public function detail(Request $request, $id)
    {
        $title = '简历详情';
        $resume = CiciResume::findOrFail($id);

        $region = Region::getInstance();
        // dd($region->getNameByAdcode('110000'));

        // $feedbacks_obj = $resume->getFeedbacks()->where(['rid' => $id, 'show' => 1])->orderBy('created_at', 'desc')->get(['text', 'creater', 'created_at']);
        // $feedbacks = array();

        // foreach ($feedbacks_obj as $fitem) {
        //     $keys = explode(' ', $fitem->created_at);

        //     $date = $keys[0];
        //     if ($keys[0] == date("Y-m-d")) {
        //         $date = '今天';
        //     } elseif ($keys[0] == date("Y-m-d", strtotime("-1 day"))) {
        //         $date = '昨天';
        //     }

        //     $feedbacks[$date][] = array(
        //         'text'    => $fitem->text,
        //         'creater' => Auth::user($fitem->creater)->name,
        //         'ctime'   => $keys[1]);
        // }

        return view('Lieplus::resume.detail', [
            'title'     => $title,
            'resume'    => $resume,
            //'feedbacks' => $feedbacks,
        ]);
    }

    // public function edit(Request $request)
    // {
    //     $data = $request->input();
    //     $id = $data['pk'];
    //     $resume = Resume::find($id);
    //     $resume->{$data['name']} = $data['value'];
    //     $resume->modifier = Auth::id();

    //     if (!$resume->save()) {
    //         return '更新失败';
    //     }
    // }

    // public function mylibrary()
    // {
    //     $title = '我的简历库';
    //     if (Auth::user()->hasRole('admin')) {
    //         $lines = Line::all();
    //     } else {
    //         $assignlines = AssignLine::with('line')->where(['uid' => Auth::id(), 'show' => 1])->get();
    //         if ($assignlines) {
    //             $lines = array_pluck($assignlines, 'line');
    //         } else {
    //             $lines = [];
    //         }
    //     }
    //     return view('resume.my', compact('title', 'lines'));
    // }

    // public function joblibrary()
    // {
    //     $title = '我的职位简历库';
    //     if (Auth::user()->hasRole('admin')) {
    //         $lines = Line::all();
    //     } else {
    //         $assignlines = AssignLine::where(['uid' => Auth::id(), 'show' => 1])->get();
    //         if ($assignlines) {
    //             $lines = array_pluck($assignlines, 'line');
    //         } else {
    //             $lines = [];
    //         }
    //     }
    //     return view('resume.job', compact('title', 'lines'));
    // }

    // public function all()
    // {
    //     $title = '猎加简历';
    //     if (Auth::user()->hasRole('admin')) {
    //         $lines = Line::all();
    //     } else {
    //         $assignlines = AssignLine::where(['uid' => Auth::id(), 'show' => 1])->get();
    //         if ($assignlines) {
    //             $lines = array_pluck($assignlines, 'line');
    //         } else {
    //             $lines = [];
    //         }
    //     }
    //     return view('resume.all', compact('title', 'lines'));
    // }

    // public function search(Request $request, $type)
    // {
    //     $resumes = [];
    //     if ('my' == $type) {
    //         $resumes = array_pluck(MyLibrary::with('resume')->where(['uid' => Auth::id(), 'show' => 1])->latest()->orderByDesc('id')->get(), 'resume');
    //     }
    //     if ('job' == $type) {
    //         $resumes = array_pluck(JobLibrary::with('resume')->where(['uid' => Auth::id(), 'show' => 1])->latest()->orderByDesc('id')->get(), 'resume');
    //     }
    //     if ('all' == $type) {
    //         $resumes = Resume::where(['show' => 1])->latest()->orderByDesc('id')->get(['id', 'sn', 'name', 'mobile', 'email', 'feedback', 'created_at']);
    //     }
    //     foreach ($resumes as $key => $resume) {
    //         $lsx = [];
    //         $joblibraries = $resume->with('joblibraries')->where(['id' => $resume->id])->first(['id', 'sn', 'name', 'mobile', 'email', 'feedback', 'created_at'])->joblibraries;
    //         foreach ($joblibraries as $joblibrary) {
    //             if (isset($joblibrary->line->sn) && isset($joblibrary->line->job->name)) {
    //                 $lsx[] = $joblibrary->line->sn . '(' . $joblibrary->line->job->name . ')';
    //             }
    //         }
    //         $resumes[$key]           = $resume;
    //         $resumes[$key]['lsx']    = $lsx;
    //         $resumes[$key]['isMine'] = $resume->isMine;
    //     }
    //     return Datatables::of($resumes)->make();
    // }

    // public function addmy(Request $request, $id)
    // {
    //     $mylibrary = MyLibrary::where(['rid' => $id, 'uid' => Auth::id()])->first();
    //     if (!empty($mylibrary)) {
    //         return json_encode(['code' => 1, 'msg' => '简历已经在我的简历库中！']);
    //     }
    //     $mylibrary          = new MyLibrary();
    //     $mylibrary->rid     = $id;
    //     $mylibrary->uid     = Auth::id();
    //     $mylibrary->creater = Auth::id();
    //     if ($mylibrary->save()) {
    //         return json_encode(['code' => 0, 'msg' => '操作成功！']);
    //     }
    //     return json_encode(['code' => 2, 'msg' => '操作失败！']);
    // }

    // public function addjob(Request $request)
    // {
    //     $this->validate($request, [
    //         'rid' => 'required',
    //         'jid' => 'required',
    //     ], [
    //         'jid.required' => '请选择:attribute.',
    //     ], [
    //         'rid' => '简历',
    //         'jid' => '职位流水线',
    //     ]);
    //     $data       = $request->input();
    //     $rid        = $data['rid'];
    //     $jid        = $data['jid'];
    //     $joblibrary = JobLibrary::where(compact('rid', 'jid'))->first();
    //     if (!empty($joblibrary)) {
    //         return json_encode(['code' => 1, 'msg' => '简历已经在该职位流水线中！']);
    //     }
    //     $joblibrary          = new JobLibrary();
    //     $joblibrary->rid     = $rid;
    //     $joblibrary->jid     = $jid;
    //     $joblibrary->uid     = Auth::id();
    //     $joblibrary->creater = Auth::id();
    //     if ($joblibrary->save()) {
    //         return json_encode(['code' => 0, 'msg' => '操作成功！']);
    //     }
    //     return json_encode(['code' => 2, 'msg' => '操作失败！']);
    // }

    // public function jobmodal(Request $request, $id)
    // {
    //     if ($request->isMethod('GET')) {
    //         $resume = Resume::findOrFail($id);
    //         $jids   = array_pluck($resume->joblibraries, 'jid');
    //         //dd($jids);
    //         $lines  = [];
    //         if (Auth::user()->hasRole('admin')) {
    //             $lines = Line::all();
    //         } else {
    //             $assignlines = AssignLine::where(['uid' => Auth::id(), 'show' => 1])->get();
    //             if ($assignlines) {
    //                 $lines = array_pluck($assignlines, 'line');
    //             }
    //         }
    //         foreach ($lines as $line) {
    //             $line->isAssigned = 0;
    //             if (in_array($line->job->id, $jids)) {
    //                 $line->isAssigned = 1;
    //             }
    //         }
    //     }
    //     return view('resume.modaljob', compact('lines', 'resume'));
    // }
}
