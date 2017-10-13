@extends('layouts.cici')

@section('content')
@include('common.messages')

{{-- <h3 class="pull-left">{{ $line->sn }} 交付流水线 </h3>
 --}}<div class="tabbable">
    <ul class="nav nav-tabs padding-18 tab-size-bigger" id="myTab">
        <li class="active">
            <a data-toggle="tab" href="#resume-tab-1" aria-expanded="false">
                <i class="blue ace-icon fa fa-hand-o-down bigger-120"></i>
                主页
            </a>
        </li>
        <li class="">
            <a data-toggle="tab" href="#resume-tab-2" aria-expanded="false">
                <i class="green ace-icon fa fa-folder bigger-120"></i>
                职位简历库
            </a>
        </li>
        <li class="">
            <a data-toggle="tab" href="#resume-tab-3" aria-expanded="false">
                <i class="pink ace-icon fa fa-cc bigger-120"></i>
                交付工作台
            </a>
        </li>
        <li class="">
            <a data-toggle="tab" href="#resume-tab-4" aria-expanded="false">
                <i class="orange ace-icon fa fa-bullhorn bigger-120"></i>
                职位动态
            </a>
        </li>
        <li class="">
            <a data-toggle="tab" href="#resume-tab-5" aria-expanded="false">
                <i class="black ace-icon fa fa-cogs bigger-120"></i>
                模板库
            </a>
        </li>
    </ul>

    <div class="tab-content no-border padding-24">
        {{-- 流水线信息--开始 --}}
        <div id="resume-tab-1" class="tab-pane fade active in">
            <h4 class="blue">
                <i class="blue ace-icon fa fa-hand-o-down bigger-110"></i>
                交付流水线信息
            </h4>
            <div class="space-8"></div>
            <div class="row">
            <div class="col-xs-6 col-sm-6">
            <div class="clearfix">
                <div class="col-xs-12 col-sm-12">
                    <a href="#" class="btn btn-default btn-app radius-4">
                        <i class="ace-icon fa fa-user bigger-230"></i>
                        {{ App\Helper::getUser($line->job->customer->creater)->name }}
                    </a>
                    <a href="#" class="btn btn-app btn-primary no-radius">
                        <i class="ace-icon fa fa-low-vision bigger-230"></i>
                        {{ empty($line->exclusive) ? '公共' : '专属：App\Helper::getUser($line->exclusive)->name' }}
                    </a>
                    <a href="#" class="btn btn-app btn-success">
                        <i class="ace-icon fa fa-lightbulb-o bigger-230"></i>
                        {{ $line->priority }}
                    </a>
                </div>
                <div class="col-xs-12">
                    {{-- 交付工作台--开始 --}}
                    <h4 class="blue">
                        <i class="blue ace-icon fa fa-cc bigger-110"></i>
                        侯选人交付工作台
                    </h4>
                    <div class="space-8"></div>

                    <div class="profile-user-info profile-user-info-striped">
                        <div class="profile-info-row">
                            <div class="profile-info-name"> 联系中： </div>
                            <div class="profile-info-value">
                                <span class="editable editable-click" id="username" style="display: inline;">{{ count($line->connection) }}</span>
                            </div>
                        </div>
                        <div class="profile-info-row">
                            <div class="profile-info-name"> 意向中： </div>
                            <div class="profile-info-value">
                                <span class="editable editable-click" id="username" style="display: inline;">{{ count($line->intention) }}</span>
                            </div>
                        </div>
                        <div class="profile-info-row">
                            <div class="profile-info-name"> 推荐中： </div>
                            <div class="profile-info-value">
                                <span class="editable editable-click" id="gender" style="display: inline;">{{ count($line->recommendation) }}</span>
                            </div>
                        </div>
                        <div class="profile-info-row">
                            <div class="profile-info-name"> 面试中： </div>
                            <div class="profile-info-value">
                                <span class="editable editable-click" id="username" style="display: inline;">{{ count($line->interview) }}</span>
                            </div>
                        </div>
                        <div class="profile-info-row">
                            <div class="profile-info-name"> offer中： </div>
                            <div class="profile-info-value">
                                <span class="editable editable-click" id="gender" style="display: inline;">{{ count($line->offer) }}</span>
                            </div>
                        </div>
                        <div class="profile-info-row">
                            <div class="profile-info-name"> 入职中： </div>
                            <div class="profile-info-value">
                                <span class="editable editable-click" id="mobile" style="display: inline;">{{ count($line->onboard) }}</span>
                            </div>
                        </div>
                    </div>
                    {{-- 交付工作台--结束 --}}
                </div>
            </div>
            </div>
            <div class="col-xs-6 col-sm-6">
            <div class="clearfix">
            <div class="col-xs-12 col-sm-12">
            {{-- 职位信息--开始 --}}
            <h4 class="blue">
                <i class="blue ace-icon fa fa-hand-o-down bigger-110"></i>
                职位信息
            </h4>
            <div class="space-8"></div>

            <div class="profile-user-info profile-user-info-striped">
                <div class="profile-info-row">
                    <div class="profile-info-name"> 职位名称： </div>
                    <div class="profile-info-value">
                        <span class="editable editable-click" id="username" style="display: inline;">{{ $line->job->name }}</span>
                    </div>
                </div>
                <div class="profile-info-row">
                    <div class="profile-info-name"> 客户全称： </div>
                    <div class="profile-info-value">
                        <span class="editable editable-click" id="username" style="display: inline;">{{ $line->job->customer->name }}</span>
                    </div>
                </div>
                <div class="profile-info-row">
                    <div class="profile-info-name"> 招聘部门： </div>
                    <div class="profile-info-value">
                        <span class="editable editable-click" id="gender" style="display: inline;">{{ App\Department::name($line->job->did) }}</span>
                    </div>
                </div>
                <div class="profile-info-row">
                    <div class="profile-info-name"> 任职要求(JD): </div>
                    <div class="profile-info-value">
                        <span class="editable editable-click" id="username" style="display: inline;">{{ $line->job->name }}</span>
                    </div>
                </div>
                <div class="profile-info-row">
                    <div class="profile-info-name"> 总工作年限： </div>
                    <div class="profile-info-value">
                        <span class="editable editable-click" id="gender" style="display: inline;">{{ empty($line->job->workyears) ? '不限' : $line->job->workyears }}</span>
                    </div>
                </div>
                <div class="profile-info-row">
                    <div class="profile-info-name"> 性别要求： </div>
                    <div class="profile-info-value">
                        <span class="editable editable-click" id="mobile" style="display: inline;">{{ empty($line->job->gender) ? '不限' : $line->job->gender }}</span>
                    </div>
                </div>
                <div class="profile-info-row">
                    <div class="profile-info-name"> 专业要求： </div>
                    <div class="profile-info-value">
                        <span class="editable editable-click" id="email" style="display: inline;">{{ empty($line->job->majors) ? '不限' : $line->job->majors }}</span>
                    </div>
                </div>
                <div class="profile-info-row">
                    <div class="profile-info-name"> 学历要求： </div>
                    <div class="profile-info-value">
                        <span class="editable editable-click" id="degree" style="display: inline;">{{ empty($line->job->degree) ? '不限' : $line->job->degree }}</span>
                    </div>
                </div>

                <div class="profile-info-row">
                    <div class="profile-info-name"> 统招全日制： </div>

                    <div class="profile-info-value">
                        <span class="editable editable-click" id="birthdate">{{ $line->job->unified == '1' ? '是' : '否' }}</span>
                    </div>
                </div>

                <div class="profile-info-row">
                    <div class="profile-info-name"> 薪酬结构： </div>

                    <div class="profile-info-value">
                        <span class="editable editable-click" id="startworkdate">{{ $line->job->salary }}</span>
                    </div>
                </div>
            </div>
            {{-- 职位信息--结束 --}}
            </div>
            </div>
            </div>
            </div>
        </div>
        {{-- 流水线信息--结束 --}}

        {{-- 职位简历库--开始 --}}
        <div id="resume-tab-2" class="tab-pane fade">
            <div class="pull-left">
                <h4 class="green">
                    <i class="green ace-icon fa fa-folder bigger-110"></i>
                    职位简历库
                </h4>
            </div>
            <div class="pull-right">
                <button class="btn btn-link">
                    <a href="/resume/add?jid={{ $line->jid }}"><i class="ace-icon fa fa-plus-circle bigger-110"></i>
                    增加简历</a>
            </div>

            @include('station.list', ['stations' => $line->joblibrary])

        </div>
        {{-- 职位简历库--结束 --}}

        {{-- 交付工作台--开始 --}}
        <div id="resume-tab-3" class="tab-pane fade">
            <h4 class="pink">
                <i class="pink ace-icon fa fa-cc bigger-110"></i>
                交付工作台
            </h4>

            <div class="space-8"></div>
<div class="tabbable tabs-left">
                                            <ul class="nav nav-tabs" id="myTab3">
                                                <li class="active">
                                                    <a data-toggle="tab" href="#connection">
                                                        <i class="ace-icon fa fa-arrow-down bigger-110"></i>
                                                        联系中
                                                    </a>
                                                </li>

                                                <li>
                                                    <a data-toggle="tab" href="#intention">
                                                        <i class="grey ace-icon fa fa-arrow-down bigger-110"></i>
                                                        意向中
                                                    </a>
                                                </li>

                                                <li>
                                                    <a data-toggle="tab" href="#recommendation">
                                                        <i class="pink ace-icon fa fa-arrow-down"></i>
                                                        推荐中
                                                    </a>
                                                </li>
                                                <li>
                                                    <a data-toggle="tab" href="#interview">
                                                        <i class="orange ace-icon fa fa-arrow-down"></i>
                                                        面试中
                                                    </a>
                                                </li>
                                                <li>
                                                    <a data-toggle="tab" href="#offer">
                                                        <i class="blue ace-icon fa fa-arrow-down"></i>
                                                        offer中
                                                    </a>
                                                </li>
                                                <li>
                                                    <a data-toggle="tab" href="#onboard">
                                                        <i class="green ace-icon fa fa-arrow-down"></i>
                                                        入职中
                                                    </a>
                                                </li>
                                            </ul>

                                            <div class="tab-content">
                                                <div id="connection" class="tab-pane in active">
                                                @include('station.list', ['stations' => $line->connection])
                                                </div>

                                                <div id="intention" class="tab-pane">
                                                @include('station.list', ['stations' => $line->intention])
                                                </div>

                                                <div id="recommendation" class="tab-pane">
                                                @include('station.list', ['stations' => $line->recommendation])
                                                </div>
                                                <div id="interview" class="tab-pane">
                                                @include('station.list', ['stations' => $line->interview])
                                                </div>
                                                <div id="offer" class="tab-pane">
                                                @include('station.list', ['stations' => $line->offer])
                                                </div>
                                                <div id="onboard" class="tab-pane">
                                                @include('station.list', ['stations' => $line->onboard])
                                                </div>
                                            </div>
                                        </div>
        </div>
        {{-- 交付工作台--结束 --}}

        {{-- 职位动态--开始 --}}
        <div id="resume-tab-3" class="tab-pane fade">
            <h4 class="orange">
                <i class="orange ace-icon fa fa-bullhorn bigger-110"></i>
                职位动态
            </h4>

            <div class="space-8"></div>

        </div>
        {{-- 职位动态--结束 --}}

        {{-- 模板库--开始 --}}
        <div id="resume-tab-4" class="tab-pane fade">
            <h4 class="black">
                <i class="black ace-icon fa fa-cogs bigger-110"></i>
                模板库
            </h4>

            <div class="space-8"></div>

        </div>
        {{-- 模板库--结束 --}}
   </div>
</div>
@endsection

@section('breadcrumbs')
{!! Breadcrumbs::render('line.detail', $line->id) !!}
@endsection

@section('stylesheet')
<link rel="stylesheet" href="{{ asset('static/css/bootstrap-editable.min.css') }}" />
<link rel="stylesheet" href="{{ asset('static/css/ace.min.css') }}" />
<link rel="stylesheet" href="{{ asset('static/css/dataTables.bootstrap.min.css') }}" />
@endsection

@section('scripts')

<script src="{{ asset('static/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('static/js/jquery.dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('static/js/select2.min.js') }}"></script>
<script src="{{ asset('static/js/jquery.hotkeys.index.min.js') }}"></script>
<script src="{{ asset('static/js/ace.min.js') }}"></script>
<script src="{{ asset('static/js/bootstrap-wysiwyg.min.js') }}"></script>
<script src="{{ asset('static/js/ace-elements.min.js') }}"></script>
<script src="{{ asset('static/js/bootstrap-editable.min.js') }}"></script>
<script src="{{ asset('static/js/ace-editable.min.js') }}"></script>

<!-- inline scripts related to this page -->
<script type="text/javascript">
    $(document).ready(function(){
        $('span[id^=feedback]').each(function(){
            $(this).editable({
                params: {'_token' : '{{ csrf_token() }}'},
                validate: function(value) {
                    if($.trim(value) == '') {
                        return '反馈不能为空！';
                    }
                }

            });
        });

        $('table.table').dataTable({
            language: {
                url: '{{ asset('static/localisation/Chinese.json') }}'
            },
        });
    });
</script>
@endsection