@extends('Lieplus::layouts.cici')

@section('title', '我的职位简历库')

@section('css')
    <style>
        .select2-selection__clear {
            cursor: pointer;
            float: right;
            margin-right: 40px;
            font-weight: bold
        }
    </style>
@endsection

@include('Lieplus::resume.list', ['t' => 'job', 'id' => $id, 'lines' => $lines ])
