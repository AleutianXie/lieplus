@extends('layouts.lieplus')

@section('title'){{ $title }}@endsection

@section('stylesheet')
<link rel="stylesheet" href="{{ asset('static/css/select2.min.css') }}" />
{{-- <link rel="stylesheet" href="{{ asset('static/css/bootstrap-datepicker3.min.css') }}" /> --}}
<link rel="stylesheet" href="{{ asset('static/css/bootstrap-editable.min.css') }}" />
@endsection

@section('content')
@include('customer.detail', ['audit' => false])
@endsection

@section('scripts')
<script src="{{ asset('static/js/select2.min.js') }}"></script>
{{-- <script src="{{ asset('static/js/bootstrap-datepicker.min.js') }}"></script> --}}
<script src="{{ asset('static/js/jquery.hotkeys.index.min.js') }}"></script>
<script src="{{ asset('static/js/bootstrap-wysiwyg.min.js') }}"></script>
<script src="{{ asset('static/js/bootstrap-editable.min.js') }}"></script>
<script src="{{ asset('static/js/ace-editable.min.js') }}"></script>
<script type="text/javascript">
jQuery(function($) {
    //editables on first profile page
    $.fn.editable.defaults.mode = 'inline';

    $('#name').editable({
        type: 'text',
        name: 'name',
        url: '/customer/edit',
        params: {'_token' : '{{ csrf_token() }}'},
        pk: {{ $customer->id }},
        validate: function(value) {
            if($.trim(value) == '') {
                return '公司全称不能为空！';
            }
        }
    });

    //select2 editable
    var provinces = [];
    $.each({!! json_encode($provinces) !!}, function(k, v) {
        provinces.push({id: k, text: v});
    });

    var cities = [];
    @foreach ($cities as $key => $value)
        cities[{{ $key }}] = [];
        $.each({!! json_encode($value) !!}, function(k, v){
            cities[{{ $key }}].push({id: k, text: v});
        });
    @endforeach

    var counties = [];
    @foreach ($counties as $key => $value)
        counties[{{ $key }}] = [];
        $.each({!! json_encode($value) !!}, function(k, v){
            counties[{{ $key }}].push({id: k, text: v});
        });
    @endforeach

    var currentProvinceValue = "NL";
    var currentCityValue = "NL";
    $('#country').editable({
        type: 'select2',
        source: provinces,
        name : 'province',
        url: '/customer/edit',
        params: {'_token' : '{{ csrf_token() }}'},
        pk: {{ $customer->id }},
        select2: {
            'width': 140
        },
        success: function(response, newValue) {
            if(currentProvinceValue == newValue) return;
            currentProviceValue = newValue;

            var new_source = (!newValue || newValue == "") ? [] : cities[newValue];

            //so we remove it altogether and create a new element
            $('#county').text('Select County');
            var city = $('#city').get(0);
            $(city).clone().attr('id', 'city').text('Select City').editable({
                type: 'select2',
                source: new_source,
                name : 'city',
                url: '/customer/edit',
                params: {'_token' : '{{ csrf_token() }}'},
                pk: {{ $customer->id }},
                select2: {
                    'width': 140
                },
                success: function(response, newValue) {
                    if(currentCityValue == newValue) return;
                    currentCityValue = newValue;

                    var new_source = (!newValue || newValue == "") ? [] : counties[newValue];

                    var county = $('#county').get(0);
                    $(county).clone().attr('id', 'county').text('Select County').editable({
                        type: 'select2',
                        value : null,
                        source: new_source,
                        name : 'county',
                        url: '/customer/edit',
                        params: {'_token' : '{{ csrf_token() }}'},
                        pk: {{ $customer->id }},
                        select2: {
                            'width': 140
                        }
                    }).insertAfter(county);//insert it after previous instance
                    $(county).remove();//remove previous instance
                }
            }).insertAfter(city);//insert it after previous instance
            $(city).remove();//remove previous instance

     }
    });


    $('#welfare').editable({
        type: 'select2',
        url: '/customer/edit',
        params: {'_token' :'{{ csrf_token() }}'},
        pk: {{ $customer->id }},
        //onblur:'ignore',
        source: {!! json_encode(config('lieplus.welfare')) !!},
        select2: {
            minimumResultsForSearch: Infinity,
            'width': 140,
        }
    });

    $('#worktime').editable({
        type: 'select2',
        url: '/customer/edit',
        params: {'_token' :'{{ csrf_token() }}'},
        pk: {{ $customer->id }},
        //onblur:'ignore',
        source: {!! json_encode(config('lieplus.worktime')) !!},
        select2: {
            minimumResultsForSearch: Infinity,
            'width': 140,
        }
    });

    $('#founder').editable({
        type: 'text',
        name: 'founder',
        url: '/customer/edit',
        params: {'_token' : '{{ csrf_token() }}'},
        pk: {{ $customer->id }},
    });

    $('#financing').editable({
        type: 'select2',
        url: '/customer/edit',
        params: {'_token' :'{{ csrf_token() }}'},
        pk: {{ $customer->id }},
        //onblur:'ignore',
        source: {!! json_encode(config('lieplus.financing')) !!},
        select2: {
            minimumResultsForSearch: Infinity,
            'width': 140,
        }
    });

    $('#industry').editable({
        type: 'select2',
        url: '/customer/edit',
        params: {'_token' :'{{ csrf_token() }}'},
        pk: {{ $customer->id }},
        //onblur:'ignore',
        source: {!! json_encode(config('lieplus.industry')) !!},
        select2: {
            minimumResultsForSearch: Infinity,
            'width': 140,
        }
    });

    $('#ranking').editable({
        type: 'select2',
        url: '/customer/edit',
        params: {'_token' :'{{ csrf_token() }}'},
        pk: {{ $customer->id }},
        //onblur:'ignore',
        source: {!! json_encode(config('lieplus.ranking')) !!},
        select2: {
            minimumResultsForSearch: Infinity,
            'width': 140,
        }
    });

    $('#property').editable({
        type: 'select2',
        url: '/customer/edit',
        params: {'_token' :'{{ csrf_token() }}'},
        pk: {{ $customer->id }},
        //onblur:'ignore',
        source: {!! json_encode(config('lieplus.companyproperty')) !!},
        select2: {
            minimumResultsForSearch: Infinity,
            'width': 160,
        }
    });

    $('#size').editable({
        type: 'select2',
        url: '/customer/edit',
        params: {'_token' :'{{ csrf_token() }}'},
        pk: {{ $customer->id }},
        //onblur:'ignore',
        source: {!! json_encode(config('lieplus.companysize')) !!},
        select2: {
            minimumResultsForSearch: Infinity,
            'width': 140,
        }
    });

    $('#introduce').editable({
        mode: 'inline',
        type: 'wysiwyg',
        name : 'introduce',
        url: '/customer/edit',
        params: {'_token' : '{{ csrf_token() }}'},
        pk: {{ $customer->id }},

        wysiwyg : {
            css : {'width':'900px'},
            toolbar:
        [
            'font',
            null,
            'fontSize',
            null,
            {name:'bold', className:'btn-info'},
            {name:'italic', className:'btn-info'},
            {name:'strikethrough', className:'btn-info'},
            {name:'underline', className:'btn-info'},
            null,
            {name:'insertunorderedlist', className:'btn-success'},
            {name:'insertorderedlist', className:'btn-success'},
            {name:'outdent', className:'btn-purple'},
            {name:'indent', className:'btn-purple'},
            null,
            {name:'justifyleft', className:'btn-primary'},
            {name:'justifycenter', className:'btn-primary'},
            {name:'justifyright', className:'btn-primary'},
            {name:'justifyfull', className:'btn-inverse'},
            null,
            {name:'createLink', className:'btn-pink'},
            {name:'unlink', className:'btn-pink'},
            null,
            {name:'insertImage', className:'btn-success'},
            null,
            'foreColor',
            null,
            {name:'undo', className:'btn-grey'},
            {name:'redo', className:'btn-grey'}
        ],
        },
        success: function(response, newValue) {
        }
    });
});
</script>
@endsection