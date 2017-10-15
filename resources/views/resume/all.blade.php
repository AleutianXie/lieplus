@extends('layouts.cici')
@section('title'){{ $title }}@endsection

@section('content')
@include('resume.list', ['type' => 'all'])
{{-- <resume-list resumes="{{ $resumes }}"></resume-list> --}}
@endsection

@section('breadcrumbs')
{!! Breadcrumbs::render('resume.all')  !!}
@endsection