@extends('layouts.cici')

@section('title'){{ $title }}@endsection

@section('content')
@include('customer.detail', ['audit' => true])
@endsection

@section('scripts')
<script src="{{ asset('static/js/wizard.min.js') }}"></script>
<script type="text/javascript">
jQuery(function($) {

});
</script>
@endsection