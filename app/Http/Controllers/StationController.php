<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Station;

class StationController extends Controller
{
    //
    public function __construct()
    {
        //$this->middleware('auth:api', ['except' => 'login']);
        $this->middleware('auth');
    }

    public function next(Request $request, $lid, $rid)
    {
        $staion = Station::where(['lid' => $lid, 'rid' => $rid])->first();
        if ($staion->next()) {
            return '操作成功！';
        };
        return '操作失败！';
    }

    public function abandon(Request $request, $lid, $rid)
    {
        $staion = Station::where(['lid' => $lid, 'rid' => $rid])->first();
        $staion->abandon();
    }

    public function reactive(Request $request, $lid, $rid)
    {
        $staion = Station::where(['lid' => $lid, 'rid' => $rid])->first();
        $staion->reactive();
    }
}
