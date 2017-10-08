<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Alert;
use App\Resume;


class AlertController extends Controller
{
    //
    public function edit(Request $request, $rid, $id)
    {
        $alert = Alert::findOrFail($id);
        $resume = Resume::findOrFail($rid);

        return view('alert.detail', compact('alert', 'resume'));
    }

    public function add(Request $request, $rid)
    {
        //$resume = Resume::findOrFail($id);
        $alert = new Alert();
        $resume = Resume::findOrFail($rid);
        return view('alert.add', compact('alert', 'resume'));
    }

    public function save(Request $request)
    {
        $this->validate($request, [
            'alert_at' => 'required|date',
            'description' => 'required',
            'operator' => 'required'
        ]);

        $alert = new Alert();
        if (!empty($request->id)) {
            $alert = Alert::findOrFail($request->id);
            $alert->alert_at = $request->alert_at;
            $alert->description = $request->description;
            //$alert->operator = $request->operator;
            $alert->operator = Auth::id();
            $alert->modifier = Auth::id();
        } else { //新建
            $alert->rid = $request->rid;
            $alert->alert_at = $request->alert_at;
            $alert->description = $request->description;
            //$alert->operator = $request->operator;
            $alert->operator = Auth::id();
            $alert->creater = Auth::id();
            $alert->modifier = Auth::id();
        }

        if ($alert->save()) {
            return redirect('/resume/'.$alert->rid.'#resume-tab-4');
        }
        //dd($request);
    }
}
