<?php

namespace App\Http\Controllers;

use App\Line;

class LineController extends Controller {
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show the line home page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $line = Line::findOrFail(1);

        return view('line.index', ['line' => $line]);
    }
}
