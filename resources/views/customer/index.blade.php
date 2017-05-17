@extends('layouts.lieplus')

@section('title'){{ $title }}@endsection

@section('content')
@include('customer.list', ['customers' => $customers])
@endsection