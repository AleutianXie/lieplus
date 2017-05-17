@extends('layouts.cici')

@section('title'){{ $title }}@endsection

@section('content')
@include('job.list', ['job' => $jobs])
@endsection