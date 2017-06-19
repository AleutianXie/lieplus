<?php

namespace App\Http\Controllers;

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
