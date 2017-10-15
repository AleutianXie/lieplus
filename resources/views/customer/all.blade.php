@extends('layouts.cici')

@section('title'){{ $title }}@endsection

@section('content')
@include('customer.list', ['type' => 'all'])
@endsection

@section('breadcrumbs')
{!! Breadcrumbs::render('customer.all') !!}
@endsection