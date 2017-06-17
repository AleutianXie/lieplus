@extends('layouts.cici')

@section('content')
<h1>交付流水线首页</h1>

@foreach ($line->stations as $station)
    {{ $station->resume->sn }}
@endforeach
@endsection