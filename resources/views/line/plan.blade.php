@extends('layouts.cici')

@section('content')

@include('common.messages')
<h1>我的工作台</h1>

@include('station.list', ['stations' => array()])

@endsection