@extends('layouts.cici')
@section('title'){{ $title }}@endsection

@section('content')
@include('resume.list', ['resumes' => $resumes])
@endsection

@section('breadcrumbs')
{!! Breadcrumbs::render('resume.job')  !!}
@endsection