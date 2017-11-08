@extends('layouts.cici')

@section('title'){{ $title }}@endsection

@section('content')
@role('admin|manager')
@include('bd.list', ['audit' => true])
@else
<link rel="stylesheet" href="{{ asset('static/css/ace.min.css') }}" />
Access Deny!
@endrole
@endsection

@section('breadcrumbs')
{!! Breadcrumbs::render('project.audit') !!}
@endsection

@section('scripts')
<script src="{{ asset('static/js/wizard.min.js') }}"></script>
<script type="text/javascript">
jQuery(function($) {

});
</script>
@endsection