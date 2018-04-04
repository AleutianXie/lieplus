<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreResumePost;
use Cici\Lieplus\Models\Region;
use Cici\Lieplus\Models\Resume;
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
    public function index(Request $request)
    {
        $model = Resume::query();
        $filter = $request->input();
        $this->getModel($model, $filter);
        $resumes = $model->paginate()->appends($filter);
        return view('Lieplus::resume.index', compact('resumes', 'filter'));
    }

    /**
     * Show the create resume page.
     *
     * @return \Illuminate\Http\Response
     */
    public function add(StoreResumePost $request)
    {
        if ($request->isMethod('POST')) {
            try {
                $data = $request->input();
                $data['created_by'] = $request->user();
                $data['updated_by'] = $request->user();
                DB::beginTransaction();
                $resume = Resume::create($data);
                // todo: add my library
                // todo: add job library
                // todo: add to station
                DB::commit();
            } catch (Exception $e) {
                DB::rollBack();
            }
        }
        return view('Lieplus::resume.create');
    }

    public function detail(Request $request, $id)
    {
        $resume = Resume::findOrFail($id);

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

        return view('Lieplus::resume.detail', compact('resume'));
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

    private function getModel(&$model, $filter = [])
    {
        $model->latest();
    }
}
