@extends('Lieplus::layouts.cici')

@section('title', '我的简历库')

@include('Lieplus::resume.list', ['t' => 'my'])
