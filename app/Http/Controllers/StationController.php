<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Station;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StationController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function next(Request $request, $lid, $rid)
    {
        $staion = Station::where(['lid' => $lid, 'rid' => $rid])->first();
        if ($staion->next())
        {
            return '操作成功！';
        };
        return '操作失败！';
    }

    public function abandon(Request $request, $lid, $rid)
    {
        $staion = Station::where(['lid' => $lid, 'rid' => $rid])->first();
        if ($staion->abandon())
        {
            return '操作成功！';
        }
        return '操作失败！';
    }

    public function reactive(Request $request, $lid, $rid)
    {
        $staion = Station::where(['lid' => $lid, 'rid' => $rid])->first();
        if ($staion->reactive())
        {
            return '操作成功！';
        }
        return '操作失败！';
    }

    public function create(Request $request, $lid, $rid)
    {
        if (Station::where(['lid' => $lid, 'rid' => $rid])->first())
        {
            return '简历已经在工作台';
        }
        $station = new Station();
        $station->sn = Helper::generationSN('GZT');
        $station->lid = $lid;
        $station->rid = $rid;
        $station->creater = Auth::id();
        $station->modifier = Auth::id();
        if ($station->save())
        {
            return '操作成功！';
        }
        return '操作失败！';
    }
}
