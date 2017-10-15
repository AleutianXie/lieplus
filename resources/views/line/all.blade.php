@extends('layouts.cici')

@section('content')
@include('common.messages')
@include('line.list', ['type' => 'all'])
@endsection

@section('breadcrumbs')
{!! Breadcrumbs::render('line.all') !!}
@endsection