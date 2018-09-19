@extends('Lieplus::layouts.cici')

@section('title', '简历详情')

@section('css')
@endsection

@section('content')
<div class="row">
<div class="tabbable">
  <ul class="nav nav-tabs padding-2 tab-size-bigger" id="myTab">
    <li @if ('index' == $tab) class="active" @endif>
      <a href="{{ route('resume.detail', $resume->id) }}" aria-expanded="false">
        <i class="blue ace-icon fa fa-file-word-o bigger-120"></i>
        原件
      </a>
    </li>

    <li @if ('job' == $tab) class="active" @endif>
      <a href="{{ route('resume.detail', [$resume->id, 'job']) }}" aria-expanded="false">
        <i class="green ace-icon fa fa-folder bigger-120"></i>
        简历库
      </a>
    </li>

    <li @if ('feedback' == $tab) class="active" @endif>
      <a href="{{ route('resume.detail', [$resume->id, 'feedback']) }}" aria-expanded="true">
        <i class="orange ace-icon fa fa-comments bigger-120"></i>
        反馈
      </a>
    </li>

    <li @if ('notice' == $tab) class="active" @endif>
      <a href="{{ route('resume.detail',[$resume->id, 'notice']) }}" aria-expanded="true">
        <i class="purple ace-icon fa fa-bell bigger-120"></i>
        提醒
      </a>
    </li>
  </ul>

  <div class="tab-content no-border padding-2">
    {{-- 简历原件--开始 --}}
    <div id="resume-tab-1" @if ('index' == $tab) class="tab-pane fade in active" @else class="tab-pane fade" @endif>
      <div class="table-header">
        <i class="ace-icon fa fa-check bigger-110"></i>
        简历原件
        <span class="pull-right">{{ Auth::user($resume->created_by)->name }} 发表于 <time datetime="{{ $resume->created_at }}">{{ $resume->created_at }}&nbsp;&nbsp;</time></span>
      </div>
      <div class="space-2"></div>
      <div class="profile-user-info profile-user-info-striped">
        <div class="profile-info-row">
          <div class="profile-info-name"> 姓名 </div>
          <div class="profile-info-value">
            <span data-type="text" data-pk="{{ $resume->id }}" data-title="输入姓名" data-url="/resume/edit" data-name="name" id="username">{{ $resume->name }}</span>
          </div>
        </div>
        <div class="profile-info-row">
          <div class="profile-info-name"> 性别 </div>
          <div class="profile-info-value">
            <span data-type="select2" data-pk="{{ $resume->id }}" data-title="选择性别" data-value="{{ $resume->gender }}" data-url="/resume/edit" id="gender">{{ config('lieplus.gender.' . $resume->gender) }}</span>
          </div>
        </div>
        <div class="profile-info-row">
          <div class="profile-info-name"> 手机 </div>
          <div class="profile-info-value">
            <span data-type="tel" data-pk="{{ $resume->id }}" data-title="输入手机" data-url="/resume/edit" id="mobile">{{ $resume->mobile }}</span>
          </div>
        </div>
        <div class="profile-info-row">
          <div class="profile-info-name"> 邮箱 </div>
          <div class="profile-info-value">
            <span data-type="email" data-pk="{{ $resume->id }}" data-title="输入邮箱" data-url="/resume/edit" id="email">{{ $resume->email }}</span>
          </div>
        </div>
        <div class="profile-info-row">
          <div class="profile-info-name"> 学历 </div>
          <div class="profile-info-value">
            <span data-type="select2" data-pk="{{ $resume->id }}" data-title="选择学历" data-value="{{ $resume->degree }}" data-url="/resume/edit" id="degree">{{ config('lieplus.degree.'.$resume->degree) }}</span>
          </div>
        </div>
        <div class="profile-info-row">
          <div class="profile-info-name"> 城市 </div>
          <div class="profile-info-value">
            <i class="fa fa-map-marker light-orange bigger-110"></i>
            <span class="editable editable-click editable-unsaved" id="country" style="display: inline; background-color: rgba(0, 0, 0, 0);">{{ $resume->province }}</span>
            <span class="editable editable-click editable-unsaved" style="display: inline; background-color: rgba(0, 0, 0, 0);" id="city">{{ $resume->city }}</span>
            <span class="editable editable-click editable-unsaved" style="display: inline; background-color: rgba(0, 0, 0, 0);" id="county">{{ $resume->county }}</span>
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
            <span class="editable editable-click" id="startworkdate">{{ $resume->start_work_date }}</span>
          </div>
        </div>
        <div class="profile-info-row">
          <div class="profile-info-name"> 当前状态 </div>
          <div class="profile-info-value">
            <span class="editable editable-click" id="servicestatus">{{ config('lieplus.servicestatus.'.$resume->service_status.'.text') }}</span>
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
              <span class="editable editable-click editable-unsaved" id="others" style="display: inline; background-color: rgba(0, 0, 0, 0);">{!! $resume->others !!}</span></div>
        </div>
      </div>
    </div>
    {{-- 简历原件--结束 --}}

        {{-- 已加入的简历库--开始 --}}
        <div id="resume-tab-2" @if ('job' == $tab) class="tab-pane fade in active" @else class="tab-pane fade" @endif>
            <h4 class="blue">
                <i class="green ace-icon fa fa-folder bigger-110"></i>
                已加入的简历库
            </h4>

            <div class="space-8"></div>

        </div>
        {{-- 已加入的简历库--结束 --}}

        {{-- 所有反馈信息--开始 --}}
        <div id="resume-tab-3" @if ('feedback' == $tab) class="tab-pane fade in active" @else class="tab-pane fade" @endif>
        <div class="table-header">
          <i class="ace-icon fa fa-comments bigger-110"></i>
          所有反馈信息
        </div>
        <div class="space-2"></div>

        <div class="row">
          <div class="col-xs-12">
            <!-- PAGE CONTENT BEGINS -->
            @foreach($resume->feedbacks->groupBy(function ($item, $key) {
              return substr($item->created_at, 0, 10);
            }) as $key => $group)
            <div id="timeline-2" class="">
              <div class="row">
                <div class="col-xs-12 col-sm-10 col-sm-offset-1">
                  <div class="timeline-container timeline-style2">
                    <span class="timeline-label">
                      @if ($key == date('Y-m-d'))
                        <b>今天</b>
                      @elseif ($key == date("Y-m-d", strtotime("-1 day")))
                        <b>昨天</b>
                      @else
                        <b>{{ $key }}</b>
                      @endif
                    </span>
                    @foreach ($group as $feedback)
                    <div class="timeline-items">
                      <div class="timeline-item clearfix">
                        <div class="timeline-info">
                          <span class="timeline-date">{{ substr($feedback->created_at, -8) }}</span>
                          <i class="timeline-indicator btn btn-info no-hover"></i>
                        </div>
                        <div class="widget-box transparent">
                          <div class="widget-body">
                            <div class="widget-main no-padding">
                              <span class="bigger-110">
                                <a href="#" class="purple bolder">{{ Auth::User($feedback->created_by)->name }}</a>
                                <i class="ace-icon fa fa-comment-o grey"></i>
                                {{ $feedback->text }}
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
          <!-- /.col -->
          </div>
        </div>
        </div>
        {{-- 所有反馈信息--结束 --}}

        {{-- 提醒--开始 --}}
        <div id="resume-tab-4" @if ('notice' == $tab) class="tab-pane fade in active" @else class="tab-pane fade" @endif>
            <h4 class="blue">
                <i class="purple ace-icon fa fa-bell bigger-110"></i>
                提醒
            </h4>

            <div class="space-8"></div>
             @include('Lieplus::alert.list', ['alerts' => $resume->alerts ])
        </div>
        {{-- 提醒--结束 --}}
    </div>
  </div>
</div>
@endsection

@section('js')
    <script type="text/javascript">
        jQuery(function($) {
            $.fn.editable.defaults.mode = 'inline';
            $('#username').editable({
                params: {'_token' : '{{ csrf_token() }}'},
                validate: function(value) {
                    if($.trim(value) == '') {
                        return '姓名不能为空！';
                    }
                }
            });
            var gender = [];
            $.each({!! json_encode(config('lieplus.gender')) !!}, function(k, v) {
                gender.push({id: k, text: v});
            });
            $('#gender').editable({
                params: {'_token' :'{{ csrf_token() }}'},
                source: gender,
                select2: {
                    minimumResultsForSearch: Infinity,
                    'width': 140,
                }
            });

            $('#mobile').editable({
                params: {'_token' : '{{ csrf_token() }}'},
                validate: function(value) {
                    if($.trim(value) == '') {
                        return '手机号码不能为空！';
                    }
                    var regMobile = /^(((13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1}))+\d{8})$/;
                    if(!regMobile.test($.trim(value)))
                    {
                        return '请输入有效的手机号码！';
                    }
                }
            });

            $('#email').editable({
                params: {'_token' : '{{ csrf_token() }}'},
                validate: function(value) {
                    if($.trim(value) == '') {
                        return '邮箱不能为空！';
                    }
                    var regEmail = /^[a-z]([a-z0-9]*[-_]?[a-z0-9]+)*@([a-z0-9]*[-_]?[a-z0-9]+)+[\.][a-z]{2,3}([\.][a-z]{2})?$/;
                    if (!regEmail.test($.trim(value)))
                    {
                        return '请输入有效的邮箱地址！';
                    }
                }
            });

            var degree = [];
            $.each({!! json_encode(config('lieplus.degree')) !!}, function(k, v) {
                degree.push({id: k, text: v});
            });
            $('#degree').editable({
                params: {'_token' : '{{ csrf_token() }}'},
                source: degree,
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
