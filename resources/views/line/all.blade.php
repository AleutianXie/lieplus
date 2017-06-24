@extends('layouts.cici')

@section('content')
<h1>猎加职位流水线</h1>
@include('line.list', ['lines', $lines])
@endsection