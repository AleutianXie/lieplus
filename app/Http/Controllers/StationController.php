<?php

namespace App\Http\Controllers;

use App\Station;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StationController extends Controller
{

    public function next(Request $request, $lid, $rid)
    {
        $station = Station::where(['lid' => $lid, 'rid' => $rid, 'disable' => 0])->first();
        if ($station->next()) {
            return json_encode(['code' => 0, 'msg' => '操作成功！']);
        };
        return json_encode(['code' => 1, 'msg' => '操作失败！']);
    }

    public function abandon(Request $request, $lid, $rid)
    {
        $station = Station::where(['lid' => $lid, 'rid' => $rid, 'disable' => 0])->first();
        if ($station->abandon()) {
            return json_encode(['code' => 0, 'msg' => '操作成功！']);
        }
        return json_encode(['code' => 1, 'msg' => '操作失败！']);
    }

    public function reactive(Request $request, $lid, $rid)
    {
        $station = Station::where(['lid' => $lid, 'rid' => $rid])->first();
        $station->disable = 0;
        $station->status = 1;
        $station->modifier = Auth::id();
        if ($station->save()) {
            return json_encode(['code' => 0, 'msg' => '操作成功！']);
        }
        return json_encode(['code' => 1, 'msg' => '操作失败！']);
    }

    public function create(Request $request, $lid, $rid)
    {
        if (Station::where(['lid' => $lid, 'rid' => $rid, 'disable' => 0])->first()) {
            return json_encode(['code' => 2, 'msg' => '简历已经在工作台！']);
        }
        $station = new Station();
        $station->sn = Helper::generationSN('GZT');
        $station->lid = $lid;
        $station->rid = $rid;
        $station->creater = Auth::id();
        $station->modifier = Auth::id();
        if ($station->save()) {
            return json_encode(['code' => 0, 'msg' => '操作成功！']);
        }
        return json_encode(['code' => 1, 'msg' => '操作失败！']);
    }
}
