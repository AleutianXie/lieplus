@extends('layouts.cici')

@section('title')禁止访问@endsection

@section('stylesheet')
<link rel="stylesheet" href="{{ asset('static/css/select2.min.css') }}" />
<link rel="stylesheet" href="{{ asset('static/css/bootstrap-datepicker3.min.css') }}" />
<link rel="stylesheet" href="{{ asset('static/css/bootstrap-editable.min.css') }}" />
<link rel="stylesheet" href="{{ asset('static/css/ace.min.css') }}" />
@endsection

@section('content')
<style>
    .container {
        text-align: center;
        display: table-cell;
        vertical-align: middle;
    }

    .content {
        text-align: center;
        display: inline-block;
    }

    .title {
        font-size: 72px;
        margin-bottom: 40px;
    }
</style>
<div class="container">
    <div class="content">
        <div class="title red">
            <span class="red bigger-125">
                <i class="ace-icon fa fa-sitemap"></i>
                404
            </span>您走错地儿啦</div>
    </div>
</div>
@endsection
