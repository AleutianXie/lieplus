@extends('Lieplus::layouts.cici')

@section('title', '金领航客户')

@include('Lieplus::customer.list', ['filter' => $filter])
