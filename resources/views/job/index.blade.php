@extends('layouts.cici')

@section('title'){{ $title }}@endsection

@section('content')
@include('job.list', ['type' => $type])
@endsection

@section('breadcrumbs')
{!! Breadcrumbs::render($route_name) !!}
@endsection