@extends('layouts.lieplus')

@section('title'){{ $title }}@endsection

@section('content')
@include('bd.list', ['audit' => true])
@endsection

@section('scripts')
<script src="{{ asset('static/js/wizard.min.js') }}"></script>
<script type="text/javascript">
jQuery(function($) {

});
</script>
@endsection