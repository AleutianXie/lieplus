@extends('layouts.cici')

@section('content')
@include('common.messages')
@include('line.list', ['type' => 'my'])
@endsection

@section('breadcrumbs')
{!! Breadcrumbs::render('line.index') !!}
@endsection