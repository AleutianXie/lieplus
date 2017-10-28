<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Plan;
use App\Line;
use App\AssignLine;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;

class PlanController extends Controller
{
    public function index()
    {
        $title = '今日工作台';
        if (Auth::user()->hasRole('admin')) {
            $lines = Line::all();
        }
        else {
            $assignlines = AssignLine::with('line')->where(['uid' => Auth::id(), 'show' => 1])->get();
            if ($assignlines) {
                $lines = array_pluck($assignlines, 'line');
            }
            else{
                $lines = [];
            }
        }
        return   view('line.plan', compact('title', 'lines'));
    }

    public function add(Request $request)
    {
        if ($request->isMethod('POST')) {
            $this->validate($request, [
                'lid' => 'required',
            ], [
                'lid.required' => '请选择:attribute.',
            ], [
                'lid' => '职位流水线',
            ]);

            $data = $request->input();
            $lid = $data['lid'];
            $plan = Plan::where(['creater' => Auth::id(), 'show' => 1])->where('created_at', 'like', date('Y-m-d').'%')->first();
            if (!empty($plan)) {
                return json_encode(['code' => 2, 'msg' => '工作台已经在今日工作台中！']);
            }
            $plan = new Plan();
            $plan->lid = $lid;
            $plan->creater = Auth::id();
            $plan->modifier = Auth::id();
            if ($plan->save())
            {
                return json_encode(['code' => 0, 'msg' => '操作成功！']);
            }
            return json_encode(['code' => 1, 'msg' => '操作失败！']);
            }
    }

    //
    public function getStations(Request $request, $status)
    {
        $statusVal = ['1' => '联系中',
                '2' => '意向中',
                '3' => '推荐中',
                '4' => '面试中',
                '5' => 'offer中',
                '6' => '入职中'];
        $plans = Plan::with('line')->where(['creater' => Auth::id(), 'show' => 1])->where('created_at', 'like', date("Y-m-d", time()).'%')->get();
        $lines = array_pluck($plans, 'line');
        $resumes = [];
        foreach ($lines as $line) {
            foreach ($line->stations as $station) {
                //dd($station->status);
                if ($station->status == $statusVal[$status]) {
            $resumes[] = $station->resume;
                }
            }
        }
        //dd($resumes);
        return Datatables::of($resumes)->make();
    }
}
