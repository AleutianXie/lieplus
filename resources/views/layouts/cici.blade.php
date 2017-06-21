<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <!-- title, meta tags, list of stylesheets, etc ... -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="LiePlus, Cici" />
    <title>{{ config('app.name', 'Cici') }} - @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('static/css/cici.css') }}">


 <!-- inline scripts related to this page -->
        <!--[if !IE]> -->
        <script src="{{ asset('static/js/jquery-2.1.4.min.js') }}"></script>
        <script src="{{ asset('static/js/bootstrap.min.js') }}"></script>

        <!-- <![endif]-->

        <!--[if IE]>
<script src="{{ asset('static/js/jquery-1.11.3.min.js') }}"></script>
<![endif]-->

        <script type="text/javascript">
            if('ontouchstart' in document.documentElement) document.write("<script src='{{ asset('static/js/jquery.mobile.custom.min.js') }}'>"+"<"+"/script>");
        </script>

        <!-- page specific plugin scripts -->

        <!--[if lte IE 8]>
          <script src="{{ asset('static/js/excanvas.min.js') }}"></script>
        <![endif]-->
        <!-- ace scripts -->
        <script src="{{ asset('static/js/ace-elements.min.js') }}"></script>

        <script src="{{ asset('static/js/ace.min.js') }}"></script>

        <!-- ace settings handler -->
        <script src="{{ asset('static/js/ace-extra.min.js') }}"></script>

        <!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

        <!--[if lte IE 8]>
        <script src="{{ asset('static/js/html5shiv.min.js') }}"></script>
        <script src="{{ asset('static/js/respond.min.js') }}"></script>
        <![endif]-->
    @section('stylesheet')
    @show
</head>
<body class="no-skin">
    <!-- navbar goes here -->
    @section('navbar')
    @include('common.header')
    @show

    <div class="main-container ace-save-state" id="main-container">
        <!-- sidebar goes here -->
        @section('sidebar')
        @include('common.sidebar')
        @show

        <div class="main-content">
            <div class="breadcrumbs">
            <!-- breadcrumbs goes here -->
            @section('breadcrumbs')
            {!! Breadcrumbs::render('home') !!}
            @show
            </div>

            <div class="page-content">
            <!-- setting box goes here if needed -->
            @section('setting')
            {{-- 5 Settings --}}
            @show
                <div class="row">
                    <div class="col-xs-12" id="cici">
                    <!-- page content goes here -->
                    @section('content')
                    4 Content
                    @show
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.page-content -->
        </div><!-- /.main-content -->
        <!-- footer area -->
        @section('footer')
        @include('common.footer')
        @show
    </div><!-- /.main-container -->
    <!-- list of script files -->
{{--     <script src="{{ asset('static/js/cici.js') }}"></script>
 --}}
    @section('scripts')
    @show
</body>
</html>