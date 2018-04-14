@extends('Lieplus::layouts.cici')

@section('title', '简历详情')

@section('stylesheet')
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
        <div id="resume-tab-1" class="tab-pane fade in active">
            <h4 class="blue pull-left">
                <i class="ace-icon fa fa-check bigger-110"></i>
                简历原件
            </h4>

            <h6 class="pull-right">{{ Auth::user($resume->created_at)->name }} 发表于 <time datetime="{{ $resume->created_at }}">{{ $resume->created_at }}</time></h6>

            <div class="space-8"></div>

            <div class="profile-user-info profile-user-info-striped">
                <div class="profile-info-row">
                    <div class="profile-info-name"> 姓名 </div>
                    <div class="profile-info-value">
                        <span class="editable editable-click" id="username" style="display: inline;">{{ $resume->name }} {{ $resume->serial_number }}</span>
                    </div>
                </div>
                <div class="profile-info-row">
                    <div class="profile-info-name"> 性别 </div>
                    <div class="profile-info-value">
                        <span class="editable editable-click" id="gender" style="display: inline;">{{ config('lieplus.gender.' . $resume->gender) }}</span>
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
                        <span class="editable editable-click" id="degree" style="display: inline;">{{ config('lieplus.degree.'.$resume->degree) }}</span>
                    </div>
                </div>
                <div class="profile-info-row">
                    <div class="profile-info-name"> 城市 </div>

                    <div class="profile-info-value">
                        <i class="fa fa-map-marker light-orange bigger-110"></i>
                {{--         <a href="#" id="address" data-type="address" data-pk="1" data-title="Please, fill address" class="editable editable-click" data-original-title="" title=""><b>Moscow</b>, Lenina st., bld. 12</a> --}}
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

{{--             <div class="row">
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
            </div> --}}
        </div>
        {{-- 所有反馈信息--结束 --}}

        {{-- 提醒--开始 --}}
        <div id="resume-tab-4" class="tab-pane fade">
            <h4 class="blue">
                <i class="purple ace-icon fa fa-bell bigger-110"></i>
                提醒
            </h4>

            <div class="space-8"></div>
            {{-- @include('alert.list', ['alerts' => $resume->alerts ]) --}}
        </div>
        {{-- 提醒--结束 --}}
   </div>
</div>
@endsection

@section('scripts')
@endsection