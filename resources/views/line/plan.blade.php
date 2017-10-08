@extends('layouts.cici')

@section('content')

@include('common.messages')
@include('station.list', ['stations' => array()])
@endsection

@section('breadcrumbs')
{!! Breadcrumbs::render('line.plan') !!}
@endsection