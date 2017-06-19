<?php

namespace App\Http\Controllers;

use App\Feedback;
use App\Resume;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    //
    /**
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
        if ($request->isMethod('POST'))
        {
            $data = $request->input();

            $feedback = new Feedback();
            $feedback->rid = $data['pk'];
            //$feedback->$data['name'] = $data['value'];
            $feedback->text = $data['value'];
            $feedback->creater = Auth::id();
            //dd($feedback);
            if ($feedback->save())
            {
                $resume = Resume::find($data['pk']);
                $resume->feedback = $data['value'];
                if ($resume->save())
                {
                    return redirect()->back();
                }
            }
            return '新增反馈失败';
        }
    }
}
