<?php

namespace App\Http\Controllers;

use App\AssignLine;
use App\Line;
use App\Plan;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class PlanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $title = '今日工作台';
        $lines = [];
        if (Auth::user()->hasRole('admin'))
        {
            $lines = Line::all();
        }
        else
        {
            $assignlines = AssignLine::with('line')->where(['uid' => Auth::id(), 'show' => 1])->get();
            if ($assignlines)
            {
                $lines = array_pluck($assignlines, 'line');
            }
            else
            {
                $lines = [];
            }
        }
        return view('line.plan', compact('title', 'lines'));
    }

    public function add(Request $request)
    {
        if ($request->isMethod('POST'))
        {
            $this->validate($request, [
                'lid' => 'required',
            ], [
                'lid.required' => '请选择:attribute.',
            ], [
                'lid' => '职位流水线',
            ]);

            $data = $request->input();
            $lid = $data['lid'];
            $plan = Plan::where(['creater' => Auth::id(), 'show' => 1])->where('lid', $lid)
                ->where('created_at', 'like', date('Y-m-d') . '%')->first();
            if (!empty($plan))
            {
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
        $statusVal = [
            '1' => '联系中',
            '2' => '意向中',
            '3' => '审批中',
            '4' => '推荐中',
            '5' => '面试中',
            '6' => 'offer中',
            '7' => '入职中',
        ];
        $plans = Plan::with('line')->where(['creater' => Auth::id(), 'show' => 1])->where('created_at', 'like', date("Y-m-d", time()) . '%')->get();
        $lines = array_pluck($plans, 'line');
        $data = [];
        foreach ($lines as $line)
        {
            $stations = [];
            if (1 == $status)
            {
                $stations = $line->connection;
            }
            if (2 == $status)
            {
                $stations = $line->intention;
            }
            if (3 == $status)
            {
                $stations = $line->audit;
            }
            if (4 == $status)
            {
                $stations = $line->recommendation;
            }
            if (5 == $status)
            {
                $stations = $line->interview;
            }
            if (6 == $status)
            {
                $stations = $line->offer;
            }
            if (7 == $status)
            {
                $stations = $line->onboard;
            }
            foreach ($stations as $station)
            {
                $data[] = ['lid' => $line->id, 'name' => $line->sn . ' - ' . $line->job->name, 'closed' => $line->job->closed, 'resume' => $station->resume, 'recruiter' => User::find($station->modifier)->name, 'line' => $line];
            }
        }
        return Datatables::of($data)->make();
    }
}
