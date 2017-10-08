@extends('layouts.cici')

@section('content')
@include('common.messages')
@include('line.list', ['lines', $lines])
@endsection

@section('breadcrumbs')
{!! Breadcrumbs::render('line.all') !!}
@endsection