<?php

namespace App\Http\Controllers;

use Cici\Lieplus\Models\Feedback;
use Cici\Lieplus\Models\Resume;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    /**
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
        if ($request->isMethod('POST')) {
            $data = $request->input();

            $feedback = new Feedback();
            $feedback->resume_id = $data['pk'];
            $feedback->text = $data['value'];
            $feedback->created_by = Auth::id();
            if ($feedback->save()) {
                $resume = Resume::find($data['pk']);
                $resume->feedback = $data['value'];
                if ($resume->save()) {
                    return redirect()->back();
                }
            }
            return '新增反馈失败';
        }
    }
}
