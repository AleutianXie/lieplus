<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreResumePost;
use Cici\Lieplus\Models\Job;
use Cici\Lieplus\Models\Region;
use Cici\Lieplus\Models\Resume;
use DB;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
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
        $lines = $this->getLineList($request);
        return view('Lieplus::resume.my', compact('lines'));
    }

    /**
     * Show job library
     */
    public function job(Request $request, $id = 0)
    {
        if (empty($id)) {
            return view('Lieplus::resume.job');
        }

        $lines = $this->getLineList($request);
        return view('Lieplus::resume.job_resume', compact('id', 'lines'));
    }

    /**
     * Show gold link library
     */
    public function all(Request $request)
    {
        $lines = $this->getLineList($request);
        return view('Lieplus::resume.all', compact('lines'));
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

    public function edit(Request $request, $id)
    {
        if ($request->isMethod('POST')) {
            try {
                $data = $request->input();
                $resume = Resume::findOrFail($id);
                DB::beginTransaction();
                $resume->update($data);
                DB::commit();
                return redirect()->route('resume.detail', $id);
            } catch (Exception $e) {
                DB::rollBack();
            }
        }
        $resume = Resume::findOrFail($id);
        $region = Region::getInstance();
        $provinces = $region->getProvinces();
        $cities = $region->getCities($resume->province->adcode);
        $counties = $region->getCounties($resume->city->adcode);
        return view('Lieplus::resume.edit', compact('resume', 'provinces', 'cities', 'counties'));
    }

    public function lines(Request $request)
    {
        $filter = $request->input();
        $model = $request->user()->resumes()->getQuery();
        $lines = $model->paginate(30)->appends($filter);
        dd($lines);
    }

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

    public function addJob(Request $request)
    {
//         dd($request->input());
//         $this->validate($request, [
//             'rid' => 'required',
//             'jid' => 'required',
//         ], [
//             'jid.required' => '请选择:attribute.',
//         ], [
//             'rid' => '简历',
//             'jid' => '职位流水线',
//         ]);
//         $data       = $request->input();
//         $rid        = $data['rid'];
//         $jid        = $data['jid'];
//         $joblibrary = JobLibrary::where(compact('rid', 'jid'))->first();
//         if (!empty($joblibrary)) {
//             return json_encode(['code' => 1, 'msg' => '简历已经在该职位流水线中！']);
//         }
//         $joblibrary          = new JobLibrary();
//         $joblibrary->rid     = $rid;
//         $joblibrary->jid     = $jid;
//         $joblibrary->uid     = Auth::id();
//         $joblibrary->creater = Auth::id();
//         if ($joblibrary->save()) {
//             return json_encode(['code' => 0, 'msg' => '操作成功！']);
//         }
        return json_encode(['code' => 2, 'msg' => '操作失败！']);
    }

    private function getLineList(Request $request)
    {
        $model = $request->user()->resumes()->getQuery();
        $total = $model->count();
        $lines = $model->limit(30)->get();
        return new LengthAwarePaginator($lines, $total, 30, 1);
    }

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
