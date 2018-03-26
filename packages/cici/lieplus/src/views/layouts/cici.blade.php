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
    @section('stylesheet')
    @show
</head>
<body class="no-skin">
    <!-- navbar goes here -->
    @section('navbar')
    @include('Lieplus::common.header')
    @show

    <div class="main-container ace-save-state" id="main-container">
        <!-- sidebar goes here -->
        @section('sidebar')
        @include('Lieplus::common.sidebar')
        @show

        <div class="main-content">
            @if (Auth::check())
            <div class="breadcrumbs">
            <!-- breadcrumbs goes here -->
            @section('breadcrumbs')
            {!! Breadcrumbs::render('home') !!}
            @show
            </div>
            @endif

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
        @include('Lieplus::common.footer')
        @show
    </div><!-- /.main-container -->
    <!-- list of script files -->
    <script src="{{ asset('static/js/cici.js') }}"></script>
    @section('scripts')
    @show
</body>
</html>