@extends('layouts.lieplus')
@section('title'){{ $title }}@endsection

@section('content')
@include('resume.list', ['resumes' => $resumes])
@endsection