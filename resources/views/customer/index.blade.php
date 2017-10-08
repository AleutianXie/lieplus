@extends('layouts.cici')

@section('title'){{ $title }}@endsection

@section('content')
@include('customer.list', ['customers' => array_pluck($assignCustomers, 'customer')])
@endsection

@section('breadcrumbs')
{!! Breadcrumbs::render('customer') !!}
@endsection