@extends('layouts.cici')

@section('content')
@include('common.messages')
@include('line.list', ['type' => 'customer'])
@endsection

@section('breadcrumbs')
{!! Breadcrumbs::render('line.customer') !!}
@endsection