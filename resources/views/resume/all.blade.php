@extends('layouts.cici')
@section('title'){{ $title }}@endsection

@section('content')
@include('resume.list', ['resumes' => $resumes])
{{-- <resume-list resumes="{{ $resumes }}"></resume-list> --}}
@endsection

@section('breadcrumbs')
{!! Breadcrumbs::render('resume.all')  !!}
@endsection