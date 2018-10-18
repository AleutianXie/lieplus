@extends('Lieplus::layouts.cici')

@section('title', '我的职位')

@include('Lieplus::job.list', ['t' => 'my', 'filter' => $filter])
