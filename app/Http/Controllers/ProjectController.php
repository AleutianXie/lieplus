<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class ProjectController extends Controller
{
    private static $prefixTitle = '项目启动书';

    //
    public function __construct(){
        //$this->middleware('auth:api', ['except' => 'login']);
        $this->middleware('auth');
    }

    public function index()
    {
        return view('BD.project', [
            'title' => self::$prefixTitle,
            'breadcrumbs' => self::breadcrumbs()
            ]);
    }

    private static function breadcrumbs($title = null)
    {
        $retValue = array();
        $url = URL::current();
        $url = trim($url, '/index');

        if (null == $title || 'http:' == dirname($url) || 'https:' == dirname($url)) {
            return [['url' => '/', 'text' => '首页'],['url' => $url, 'text' => self::$prefixTitle]];
        }

        return [['url' => '/', 'text' => '首页'],
                ['url' => dirname($url), 'text' => self::$prefixTitle],
                ['url' => $url, 'text' => $title]];
    }

}
