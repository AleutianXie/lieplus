@extends('Lieplus::layouts.cici')

@section('title', '我的客户')

@include('Lieplus::customer.list', ['t' => 'my', 'filter' => $filter])
