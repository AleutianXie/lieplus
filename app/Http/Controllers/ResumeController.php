<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreResumePost;
use Cici\Lieplus\Models\Job;
use Cici\Lieplus\Models\Resume;
use DB;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ResumeController
{
    /**
     * Show the resume home page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('Lieplus::resume.my');
    }

    /**
     * Show the create resume page.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(StoreResumePost $request)
    {
        if ($request->isMethod('POST')) {
            try {
                $data = $request->input();
                $userId = $request->user()->id;;
                $data['created_by'] = $userId;
                $data['updated_by'] = $userId;
                DB::beginTransaction();
                $resume = Resume::create($data);
                // add my library
                $resume->assignUser(['created_by' => $userId, 'updated_by' => $userId], $userId);
                // todo: add job library
                // todo: add to station
                DB::commit();
            } catch (Exception $e) {
                DB::rollBack();
            }
        }
        return view('Lieplus::resume.create');
    }

    /**
     * Show my library
     */
    public function my(Request $request)
    {
        $filter = $request->input();
        return view('Lieplus::resume.my', compact('filter'));
    }

    /**
     * Show job library
     */
    public function job(Request $request, $id = 0)
    {
        if (empty($id)) {
            return view('Lieplus::resume.job');
        }

        return view('Lieplus::resume.job_resume', compact('id'));
    }

    /**
     * Show gold link library
     */
    public function all(Request $request)
    {
        return view('Lieplus::resume.all');
    }

    public function detail(Request $request, $id, $tab = 'index')
    {
        $resume = Resume::findOrFail($id);
        return view('Lieplus::resume.detail', compact('resume', 'tab'));
    }

    public function search(Request $request)
    {
        $filter = $request->input();
        if (!empty($filter['t']) && $filter['t'] == 'my') {
            $model = $request->user()->resumes()->getQuery();
        } elseif (!empty($filter['t']) && $filter['t'] == 'job') {
            $model = Job::findOrFail($filter['id'])->resumes()->getQuery();
        } else {
            $model = Resume::query();
        }
        $this->getModel($model, $filter);
        return Datatables::eloquent($model)->make(true);
    }

    public function edit(Request $request)
    {
        $data = $request->input();
        $id = $data['pk'];
        $resume = Resume::find($id);
        $resume->{$data['name']} = $data['value'];
        $resume->updated_by = $request->user()->id;

        if (!$resume->save()) {
            return '更新失败';
        }
    }

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

    public function addMy(Request $request, $id)
    {
        $resume = Resume::findOrFail($id);
        if ($resume->is_mine) {
            return json_encode(['code' => 1, 'msg' => '简历已经在我的简历库中！']);
        }
        $userId = $request->user()->id;
        $resume->assignUser(['created_by' => $userId, 'updated_by' => $userId], $userId);
        return json_encode(['code' => 0, 'msg' => '操作成功！']);
    }

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
        if (!empty($filter['mobile'])) {
            $model->where('mobile', 'like', '%' . $filter['mobile'] . '%');
        }
        if (!empty($filter['name'])) {
            $model->where('name', 'like', '%' . $filter['name'] . '%');
        }
        if (!empty($filter['email'])) {
            $model->where('email', 'like', '%' . $filter['email'] . '%');
        }
        $model->select('resumes.*');
        $model->latest('resumes.created_at');
    }
}
