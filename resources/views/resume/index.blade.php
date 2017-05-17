@extends('layouts.cici')

@section('title'){{ $title }}@endsection

@section('content')
<h1>Resume</h1>
<resume-add resume="{{ json_encode(config('lieplus')) }}"></resume-add>
@endsection