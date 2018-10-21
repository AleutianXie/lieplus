@extends('Lieplus::layouts.cici')

@section('title', '启动书列表')

@include('Lieplus::project.list', ['projects' => $projects])
