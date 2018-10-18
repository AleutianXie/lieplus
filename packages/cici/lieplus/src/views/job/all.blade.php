@extends('Lieplus::layouts.cici')

@section('title', '金领航职位')

@include('Lieplus::job.list', ['filter' => $filter])
