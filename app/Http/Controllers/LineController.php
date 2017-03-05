<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LineController extends Controller
{
    /**
     * Show the line home page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('line.index');
    }
}
