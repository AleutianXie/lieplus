@extends('layouts.cici')

@section('title'){{ $title }}@endsection

@section('content')
@include('customer.list', ['type' => 'my'])
@endsection

@section('breadcrumbs')
{!! Breadcrumbs::render('customer') !!}
@endsection