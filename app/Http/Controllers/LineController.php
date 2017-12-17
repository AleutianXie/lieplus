<?php

namespace App\Http\Controllers;

use App\AssignCustomer;
use App\AssignLine;
use App\Helper;
use App\Line;
use App\Station;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;

class LineController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the line home page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('line.index');
    }

    public function customer()
    {
        return view('line.customer');
    }

    public function add(Request $request)
    {
        if ($request->isMethod('POST')) {
            $this->validate($request, [
                'jid' => [
                    'required',
                    'unique:lines',
                ],
            ], [
                'jid.required' => '请选择:attribute.',
                'unique'       => '该 :attribute 您已经生成过职位交付流水线.',
            ], [
                'jid' => '职位编号(ID)',
            ]);

            $data = $request->input();
            $line = new Line();

            $line->sn = Helper::generationSN('LSX');
            $line->priority = 1;
            $line->jid = $data['jid'];
            $line->creater = Auth::id();
            $line->modifier = Auth::id();

            if ($line->save()) {
                return json_encode(['code' => 0, 'msg' => '操作成功！']);
            } else {
                return json_encode(['code' => 1, 'msg' => '操作失败！']);
            }
        }
    }

    public function all()
    {
        return view('line.all');
    }

    public function plan()
    {
        $lines = Line::where(['show' => 1])->get();

        return view('line.plan', ['lines' => $lines]);
    }

    public function detail(Request $request, $id)
    {
        $title = '流水线详情';
        $line = Line::findOrFail($id);
        return view('line.detail', [
            'title' => $title,
            'line'  => $line,
        ]);
    }

    public function assign(Request $request, $lid)
    {
        $line = Line::findOrFail($lid);
        if ($request->isMethod('POST')) {
            $data = $request->input();
            $uid = $data['uid'];
            $lid = $data['lid'];
            $this->validate($request, [
                'uid' => 'required|integer',
                'lid' => [
                    'required',
                    'integer',
                    Rule::unique('assignlines')->where(function ($query) use ($uid) {
                        $query->where('uid', $uid);
                    }),
                ],
            ], [
                'unique' => '已经分配过该 :attribute.',
            ], [
                'uid' => '用户号',
                'lid' => '流水线',
            ]);

            $assignLine = new AssignLine();
            $assignLine->uid = $uid;
            $assignLine->lid = $lid;
            $assignLine->creater = Auth::id();
            $assignLine->modifier = Auth::id();

            if ($assignLine->save()) {
                return json_encode(['code' => 0, 'msg' => '操作成功！']);
            } else {
                return json_encode(['code' => 1, 'msg' => '操作失败！']);
            }
        }

        $users = User::role('recruiter')->get();
        $aids = AssignLine::where(compact('lid'))->get(['uid']);
        $aids = array_pluck($aids, 'uid');

        return view('line.assign', compact('line', 'users', 'aids'));
    }

    public function search(Request $request, $type)
    {
        $lines = [];
        if ('my' == $type) {
            $assignLines = AssignLine::with('line')->where(['uid' => Auth::id(), 'show' => 1])->latest()->orderByDesc('id')->get(['uid', 'lid']);
            $lines = array_pluck($assignLines, 'line');
            foreach ($lines as $key => $value) {
                $value->customer = empty($value->job->customer->assigned) ? $value->job->customer->assigned : Helper::getUser($value->job->customer->assigned->adviser->id)->name;
                //$value->isMineCustomer   = empty($value->job->customer->assigned) ? 0 : Auth::id() == $value->job->customer->assigned->adviser->id;
                $value->advisers = empty($value->assign) ? $value->assign : array_map(function ($v) {
                    return Helper::getUser($v)->name;
                }, array_pluck($value->assign, 'uid'));
                //$value->isMineRecruit  = empty($value->assign) ? 0 : in_array(Auth::id(), array_pluck($value->assign, 'uid'));
                $value->department     = $value->job->department->name;
                $value->connection     = count($value->connection);
                $value->intention      = count($value->intention);
                $value->recommendation = count($value->recommendation);
                $value->interview      = count($value->interview);
                $value->offer          = count($value->offer);
                $value->onboard        = count($value->onboard);
                $lines[$key]           = $value;
            }
        }
        if ('all' == $type) {
            $lines = Line::with('job')->with('assign')->where(['show' => 1])->latest()->orderByDesc('id')->get(['id', 'sn', 'exclusive', 'priority', 'jid']);
            foreach ($lines as $key => $value) {
                $value->customer = empty($value->job->customer->assigned) ? $value->job->customer->assigned : Helper::getUser($value->job->customer->assigned->adviser->id)->name;
                //$value->isMineCustomer   = empty($value->job->customer->assigned) ? 0 : Auth::id() == $value->job->customer->assigned->adviser->id;
                $value->advisers = empty($value->assign) ? $value->assign : array_map(function ($v) {
                    return Helper::getUser($v)->name;
                }, array_pluck($value->assign, 'uid'));
                //$value->isMineRecruit  = empty($value->assign) ? 0 : in_array(Auth::id(), array_pluck($value->assign, 'uid'));
                $value->department     = $value->job->department->name;
                $value->connection     = count($value->connection);
                $value->intention      = count($value->intention);
                $value->recommendation = count($value->recommendation);
                $value->interview      = count($value->interview);
                $value->offer          = count($value->offer);
                $value->onboard        = count($value->onboard);
                $lines[$key]           = $value;
            }
        }
        if ('customer' == $type) {
            $customers = AssignCustomer::with('customer')->where(['uid' => Auth::id(), 'show' => 1])->latest()->orderByDesc('id')->get();
            $customers = array_pluck($customers, 'customer');
            foreach ($customers as $customer) {
                if (isset($customer->jobs)) {
                    $jobs = $customer->jobs;
                    foreach ($jobs as $job) {
                        if ($job->line) {
                            $line           = $job->line;
                            $line->customer = empty($line->job->customer->assigned) ? $line->job->customer->assigned : Helper::getUser($line->job->customer->assigned->adviser->id)->name;
                            //$line->isMineCustomer = empty($line->job->customer->assigned) ? 0 : Auth::id() == $line->job->customer->assigned->adviser->id;
                            $line->advisers = empty($line->assign) ? $line->assign : array_map(function ($v) {
                                return Helper::getUser($v)->name;
                            }, array_pluck($line->assign, 'uid'));
                            //$line->isMineRecruit  = empty($line->assign) ? 0 : in_array(Auth::id(), array_pluck($line->assign, 'uid'));
                            $line->department     = $line->job->department->name;
                            $line->connection     = count($line->connection);
                            $line->intention      = count($line->intention);
                            $line->recommendation = count($line->recommendation);
                            $line->interview      = count($line->interview);
                            $line->offer          = count($line->offer);
                            $line->onboard        = count($line->onboard);
                            $lines[]              = $line;
                        }
                    }
                }
            }
        }
        return Datatables::of($lines)->make();
    }

    public function getStations(Request $request, $lid, $status)
    {
        $line = Line::findOrFail($lid);
        $stations = [];
        if (0 == $status) {
            $stations = $line->joblibrary;
        }
        if (1 == $status) {
            $stations = $line->connection;
        }
        if (2 == $status) {
            $stations = $line->intention;
        }
        if (3 == $status) {
            $stations = $line->audit;
        }
        if (4 == $status) {
            $stations = $line->recommendation;
        }
        if (5 == $status) {
            $stations = $line->interview;
        }
        if (6 == $status) {
            $stations = $line->offer;
        }
        if (7 == $status) {
            $stations = $line->onboard;
        }
        if (8 == $status) {
            $stations = $line->closed;
        }
        foreach ($stations as $key => $station) {
            if (0 != $status) {
                $stations[$key]['recruiter'] = is_null($station->modifier) ? '' : User::find($station->modifier)->name;
            } else {
                $station = Station::where('disable', 0)->Library(['rid' => $station->rid, 'lid' => $station->line->id])->first();
                $stations[$key]['recruiter'] = isset($station) ? '' : User::find($station->modifier)->name;
            }

            $stations[$key]['ismine']    = $station->modifier == Auth::id() ? 1 : 0;
            $stations[$key]['resume']    = $station->resume;
            $stations[$key]['line']      = isset($station->line) ? $station->line : '';
        }
        if (!Auth::user()->hasRole('admin') && (1 == $status || 2 == $status)) {
            $stations = is_array($stations) ? $stations : $stations->toArray();
            $stations = array_where($stations, function ($station) {
                return $station['ismine'] == 1;
            });
        }
        return Datatables::of($stations)->make();
    }
}
