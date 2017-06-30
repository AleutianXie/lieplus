<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Line;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $lines = Line::where(['creater' => Auth::id(), 'show' => 1])->get();

        return view('line.index', ['lines' => $lines]);
    }

    public function add(Request $request)
    {
        if ($request->isMethod('POST'))
        {

            $this->validate($request, [
                'jid' => [
                    'required',
                    /*Rule::unique('lines')->where(function ($query)
                    {
                    $query->where('creater', Auth::id());
                    }),*/
                    'unique:lines',
                ],
            ], [
                'jid.required' => '请选择:attribute.',
                'unique' => '该 :attribute 您已经生成过职位交付流水线.',
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

            if ($line->save())
            {
                return redirect('/line/' . $line->id)->with('success', '生成职位交付流水线成功!');
            }
            else
            {
                return redirect()->back()->with('error', '生成职位交付流水线失败');
            }
        }
    }

    public function all()
    {
        $lines = Line::where(['show' => 1])->get();

        return view('line.all', ['lines' => $lines]);

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
            'line' => $line,
            //'breadcrumbs' => self::breadcrumbs($title),
        ]);
    }
}
