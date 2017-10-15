@extends('layouts.cici')
@section('title'){{ $title }}@endsection

@section('content')
@include('resume.list', ['type' => 'job'])
@endsection

@section('breadcrumbs')
{!! Breadcrumbs::render('resume.job')  !!}
@endsection