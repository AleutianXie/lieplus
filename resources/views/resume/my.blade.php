@extends('layouts.cici')
@section('title'){{ $title }}@endsection

@section('content')
@include('resume.list', ['type' => 'my'])
{{-- <resume-list resumes="{{ $resumes }}"></resume-list> --}}
@endsection

@section('breadcrumbs')
{!! Breadcrumbs::render('resume.my')  !!}
@endsection