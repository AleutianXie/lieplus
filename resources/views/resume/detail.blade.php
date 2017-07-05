@extends('layouts.cici')

@section('title'){{ $title }}@endsection

@section('stylesheet')
<link rel="stylesheet" href="{{ asset('static/css/select2.min.css') }}" />
<link rel="stylesheet" href="{{ asset('static/css/bootstrap-datepicker3.min.css') }}" />
<link rel="stylesheet" href="{{ asset('static/css/bootstrap-editable.min.css') }}" />
<link rel="stylesheet" href="{{ asset('static/css/ace.min.css') }}" />
@endsection

@section('content')
<div class="tabbable">
    <ul class="nav nav-tabs padding-18 tab-size-bigger" id="myTab">
        <li class="active">
            <a data-toggle="tab" href="#resume-tab-1" aria-expanded="false">
                <i class="blue ace-icon fa fa-file-word-o bigger-120"></i>
                原件
            </a>
        </li>

        <li class="">
            <a data-toggle="tab" href="#resume-tab-2" aria-expanded="false">
                <i class="green ace-icon fa fa-folder bigger-120"></i>
                简历库
            </a>
        </li>

        <li class="">
            <a data-toggle="tab" href="#resume-tab-3" aria-expanded="true">
                <i class="orange ace-icon fa fa-comments bigger-120"></i>
                反馈
            </a>
        </li>
        <li class="">
            <a data-toggle="tab" href="#resume-tab-4" aria-expanded="true">
                <i class="purple ace-icon fa fa-bell bigger-120"></i>
                提醒
            </a>
        </li>
    </ul>

    <div class="tab-content no-border padding-24">
        {{-- 简历原件--开始 --}}
        <div id="resume-tab-1" class="tab-pane fade active in">
            <h4 class="blue pull-left">
                <i class="ace-icon fa fa-check bigger-110"></i>
                简历原件
            </h4>

            <h6 class="pull-right">{{ $resume->publisher->name }} 发表于 <time datetime="{{ $resume->created_at }}">{{ $resume->created_at }}</time></h6>

            <div class="space-8"></div>

            <div class="profile-user-info profile-user-info-striped">
                <div class="profile-info-row">
                    <div class="profile-info-name"> 姓名 </div>
                    <div class="profile-info-value">
                        <span class="editable editable-click" id="username" style="display: inline;">{{ $resume->name }}</span>
                    </div>
                </div>
                <div class="profile-info-row">
                    <div class="profile-info-name"> 性别 </div>
                    <div class="profile-info-value">
                        <span class="editable editable-click" id="gender" style="display: inline;">{{ config('lieplus.gender.'.$resume->gender.'.text') }}</span>
                    </div>
                </div>
                <div class="profile-info-row">
                    <div class="profile-info-name"> 手机 </div>
                    <div class="profile-info-value">
                        <span class="editable editable-click" id="mobile" style="display: inline;">{{ $resume->mobile }}</span>
                    </div>
                </div>
                <div class="profile-info-row">
                    <div class="profile-info-name"> 邮箱 </div>
                    <div class="profile-info-value">
                        <span class="editable editable-click" id="email" style="display: inline;">{{ $resume->email }}</span>
                    </div>
                </div>
                <div class="profile-info-row">
                    <div class="profile-info-name"> 学历 </div>
                    <div class="profile-info-value">
                        <span class="editable editable-click" id="degree" style="display: inline;">{{ config('lieplus.degree.'.$resume->degree.'.text') }}</span>
                    </div>
                </div>
                <div class="profile-info-row">
                    <div class="profile-info-name"> 城市 </div>

                    <div class="profile-info-value">
                        <i class="fa fa-map-marker light-orange bigger-110"></i>
                {{--         <a href="#" id="address" data-type="address" data-pk="1" data-title="Please, fill address" class="editable editable-click" data-original-title="" title=""><b>Moscow</b>, Lenina st., bld. 12</a> --}}
                        <span class="editable editable-click editable-unsaved" id="country" style="display: inline; background-color: rgba(0, 0, 0, 0);">{{ App\Region::name($resume->province) }}</span>
                        <span class="editable editable-click editable-unsaved" style="display: inline; background-color: rgba(0, 0, 0, 0);" id="city">{{ App\Region::name($resume->city) }}</span>
                        <span class="editable editable-click editable-unsaved" style="display: inline; background-color: rgba(0, 0, 0, 0);" id="county">{{ App\Region::name($resume->county) }}</span>
                    </div>
                </div>

                <div class="profile-info-row">
                    <div class="profile-info-name"> 出生日期 </div>

                    <div class="profile-info-value">
                        <span class="editable editable-click" id="birthdate">{{ $resume->birthdate }}</span>
                    </div>
                </div>

                <div class="profile-info-row">
                    <div class="profile-info-name"> 开始工作日期 </div>

                    <div class="profile-info-value">
                        <span class="editable editable-click" id="startworkdate">{{ $resume->startworkdate }}</span>
                    </div>
                </div>
                <div class="profile-info-row">
                    <div class="profile-info-name"> 当前状态 </div>

                    <div class="profile-info-value">
                        <span class="editable editable-click" id="servicestatus">{{ config('lieplus.servicestatus.'.$resume->servicestatus.'.text') }}</span>
                    </div>
                </div>
                <div class="profile-info-row">
                    <div class="profile-info-name"> 当前行业 </div>

                    <div class="profile-info-value">
                        <span class="editable editable-click" id="industry">{{ $resume->industry }}</span>
                    </div>
                </div>
                <div class="profile-info-row">
                    <div class="profile-info-name"> 当前职位 </div>

                    <div class="profile-info-value">
                        <span class="editable editable-click" id="position">{{ $resume->position }}</span>
                    </div>
                </div>
                <div class="profile-info-row">
                    <div class="profile-info-name"> 期望薪资 </div>

                    <div class="profile-info-value">
                        <span class="editable editable-click" id="salary">{{ config('lieplus.salary.'.$resume->salary.'.text') }}</span>
                    </div>
                </div>
                <div class="profile-info-row">
                    <div class="profile-info-name"> 其它 </div>

                    <div class="profile-info-value" style="max-width: 900px; overflow:scroll;">
                        <span class="editable editable-click editable-unsaved" id="others" style="display: inline; background-color: rgba(0, 0, 0, 0);">{!! $resume->others !!}</span>
               </div>
                </div>
            </div>
        </div>
        {{-- 简历原件--结束 --}}

        {{-- 已加入的简历库--开始 --}}
        <div id="resume-tab-2" class="tab-pane fade">
            <h4 class="blue">
                <i class="green ace-icon fa fa-folder bigger-110"></i>
                已加入的简历库
            </h4>

            <div class="space-8"></div>

        </div>
        {{-- 已加入的简历库--结束 --}}

        {{-- 所有反馈信息--开始 --}}
        <div id="resume-tab-3" class="tab-pane fade">
            <h4 class="blue">
                <i class="orange ace-icon fa fa-comments bigger-110"></i>
                所有反馈信息
            </h4>

            <div class="space-8"></div>

            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->
                    @foreach($feedbacks as $key => $value)
                    <div id="timeline-2" class="">
                        <div class="row">
                            <div class="col-xs-12 col-sm-10 col-sm-offset-1">
                                <div class="timeline-container timeline-style2">
                                    <span class="timeline-label">
                                        <b>{{ $key }}</b>
                                    </span>
                                    @foreach($value as $feedback)
                                    <div class="timeline-items">
                                        <div class="timeline-item clearfix">
                                            <div class="timeline-info">
                                                <span class="timeline-date">{{ $feedback['ctime'] }}</span>

                                                <i class="timeline-indicator btn btn-info no-hover"></i>
                                            </div>

                                            <div class="widget-box transparent">
                                                <div class="widget-body">
                                                    <div class="widget-main no-padding">
                                                        <span class="bigger-110">
                                                            <a href="#" class="purple bolder">{{ $feedback['creater'] }}</a>
                                                            <i class="ace-icon fa fa-comment-o grey"></i>
                                                            {{ $feedback['text'] }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- /.timeline-items -->
                                    @endforeach
                                </div><!-- /.timeline-container -->
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div><!-- /.col -->
            </div>
        </div>
        {{-- 所有反馈信息--结束 --}}

        {{-- 提醒--开始 --}}
        <div id="resume-tab-4" class="tab-pane fade">
            <h4 class="blue">
                <i class="purple ace-icon fa fa-bell bigger-110"></i>
                提醒
            </h4>

            <div class="space-8"></div>
            @include('alert.list', ['alerts' => $resume->alerts ])
        </div>
        {{-- 提醒--结束 --}}
   </div>
</div>
@endsection

@section('breadcrumbs')
{!! Breadcrumbs::render('resume.detail', $resume->id) !!}
@endsection

@section('scripts')
<script src="{{ asset('static/js/select2.min.js') }}"></script>
<script src="{{ asset('static/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('static/js/jquery.hotkeys.index.min.js') }}"></script>
<script src="{{ asset('static/js/bootstrap-wysiwyg.min.js') }}"></script>
<script src="{{ asset('static/js/bootstrap-editable.min.js') }}"></script>
<script src="{{ asset('static/js/ace-editable.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('static/js/address.js') }}"></script>
<script type="text/javascript" src="{{ asset('static/js/jquery.xhashchange.min.js') }}"></script>
<script type="text/javascript">
jQuery(function($) {
    var hash = location.hash;
    var arr = [ "#resume-tab-1", "#resume-tab-2", "#resume-tab-3", "#resume-tab-4" ];

    $(window).hashchange(function () {
        hash = location.hash;

        if (jQuery.inArray( hash, arr ) == -1 ) {
            hash = "#resume-tab-1";
            location.hash = hash;
        }

        $('a[href='+hash+']').parent().addClass('active');
        $('a[href='+hash+']').parent().siblings().removeClass('active');
        $(hash).addClass('active');
        $(hash).addClass('in');
        $(hash).siblings().removeClass('active');
        $(hash).siblings().removeClass('in');
    });

    if (jQuery.inArray( hash, arr ) == -1 ) {
        hash = "#resume-tab-1";
        location.hash = hash;
    }

    $('a[href='+hash+']').parent().addClass('active');
    $('a[href='+hash+']').parent().siblings().removeClass('active');
    $(hash).addClass('active');
    $(hash).addClass('in');
    $(hash).siblings().removeClass('active');
    $(hash).siblings().removeClass('in');

    $(document.body).on("click", ".tabbable a[data-toggle]", function(event) {
        location.hash = this.getAttribute("href");
    });

    //editables on first profile page
    $.fn.editable.defaults.mode = 'inline';
    $.fn.editableform.loading = "<div class='editableform-loading'><i class='ace-icon fa fa-spinner fa-spin fa-2x light-blue'></i></div>";
    $.fn.editableform.buttons = '<button type="submit" class="btn btn-info editable-submit"><i class="ace-icon fa fa-check"></i></button>'+
                                '<button type="button" class="btn editable-cancel"><i class="ace-icon fa fa-times"></i></button>';
    //editables
    //text editable
    $('#username').editable({
        type: 'text',
        name: 'name',
        url: '/resume/edit',
        params: {'_token' : '{{ csrf_token() }}'},
        pk: {{ $resume->id }},
        validate: function(value) {
            if($.trim(value) == '') {
                return '姓名不能为空！';
            }
        }
    });

    $('#gender').editable({
        type: 'select2',
        url: '/resume/edit',
        params: {'_token' :'{{ csrf_token() }}'},
        pk: {{ $resume->id }},
        //onblur:'ignore',
        source: {!! json_encode(config('lieplus.gender')) !!},
        select2: {
            minimumResultsForSearch: Infinity,
            'value': {{ $resume->gender }},
            'width': 140,
        }
    });

    $('#mobile').editable({
        type: 'tel',
        name: 'mobile',
        url: '/resume/edit',
        params: {'_token' : '{{ csrf_token() }}'},
        pk: {{ $resume->id }},
        validate: function(value) {
            if($.trim(value) == '') {
                return '手机号码不能为空！';
            }
            var myreg = /^(((13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1}))+\d{8})$/;
            if(!myreg.test($.trim(value)))
            {
                return '请输入有效的手机号码！';
            }
        }
    });

    $('#email').editable({
        type: 'email',
        name: 'email',
        url: '/resume/edit',
        params: {'_token' : '{{ csrf_token() }}'},
        pk: {{ $resume->id }},
        validate: function(value) {
            if($.trim(value) == '') {
                return '邮箱不能为空！';
            }
        }
    });

    $('#degree').editable({
        type: 'select2',
        name : 'degree',
        url: '/resume/edit',
        params: {'_token' : '{{ csrf_token() }}'},
        pk: {{ $resume->id }},
        //onblur:'ignore',
        source: {!! json_encode(config('lieplus.degree')) !!},
        select2: {
            minimumResultsForSearch: Infinity,
            'width': 140
        }
    });

    //select2 editable
    var provinces = [];
    $.each({!! json_encode(config('lieplus.provinces')) !!}, function(k, v) {
        provinces.push({id: k, text: v});
    });

    var cities = [];
    $.each({!! json_encode(config('lieplus.cities')) !!}, function(key, value) {
        cities[key] = [];
        $.each(value, function(k, v){
            cities[key].push({id: k, text: v});
        });
    });

    var counties = [];
    $.each({!! json_encode(config('lieplus.counties')) !!}, function(key,value) {
        counties[key] = [];
        $.each(value, function(k, v) {
            counties[key].push({id: k, text: v});
        });
    });

    var currentProvinceValue = "NL";
    var currentCityValue = "NL";
    $('#country').editable({
        type: 'select2',
        value : 'NL',
        //onblur:'ignore',
        source: provinces,
        name : 'province',
        url: '/resume/edit',
        params: {'_token' : '{{ csrf_token() }}'},
        pk: {{ $resume->id }},
        //onblur:'ignore',
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
                value : 'NL',
                //onblur:'ignore',
                source: new_source,
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
                        //onblur:'ignore',
                        source: new_source,
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


    //custom date editable
    $('#birthdate').editable({
        type: 'adate',
        name: 'birthdate',
        url: '/resume/edit',
        params: {'_token' : '{{ csrf_token() }}'},
        pk: {{ $resume->id }},
        date: {
            //datepicker plugin options
            format: 'yyyy-mm-dd',
            viewformat: 'yyyy-mm-dd',
            weekStart: 1

            //,nativeUI: true//if true and browser support input[type=date], native browser control will be used
            //,format: 'yyyy-mm-dd',
            //viewformat: 'yyyy-mm-dd'
        }
    })

    $('#startworkdate').editable({
        type: 'adate',
        name: 'startworkdate',
        url: '/resume/edit',
        params: {'_token' : '{{ csrf_token() }}'},
        pk: {{ $resume->id }},
        date: {
            //datepicker plugin options
            format: 'yyyy-mm-dd',
            viewformat: 'yyyy-mm-dd',
            weekStart: 1
        }
    })

    $('#servicestatus').editable({
        type: 'select2',
        name : 'servicestatus',
        url: '/resume/edit',
        params: {'_token' : '{{ csrf_token() }}'},
        pk: {{ $resume->id }},
        //onblur:'ignore',
        source: {!! json_encode(config('lieplus.servicestatus')) !!},
        select2: {
            minimumResultsForSearch: Infinity,
            'width': 140,
        }
    });

    //text editable
    $('#industry').editable({
        type: 'text',
        name: 'industry',
        url: '/resume/edit',
        params: {'_token' : '{{ csrf_token() }}'},
        pk: {{ $resume->id }},
    });

    //text editable
    $('#position').editable({
        type: 'text',
        name: 'position',
        url: '/resume/edit',
        params: {'_token' : '{{ csrf_token() }}'},
        pk: {{ $resume->id }},
    });

    $('#salary').editable({
        type: 'select2',
        name: 'salary',
        url: '/resume/edit',
        params: {'_token' : '{{ csrf_token() }}'},
        pk: {{ $resume->id }},
        //onblur:'ignore',
        source: {!! json_encode(config('lieplus.salary')) !!},
        select2: {
            minimumResultsForSearch: Infinity,
            'width': 140
        }
    });

    $('#others').editable({
        mode: 'inline',
        type: 'wysiwyg',
        name : 'others',
        url: '/resume/edit',
        params: {'_token' : '{{ csrf_token() }}'},
        pk: {{ $resume->id }},

        wysiwyg : {
            css : {'max-width':'900px'},
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