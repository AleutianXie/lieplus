@extends('Lieplus::layouts.cici')
@section('title', '启动书详情')

@section('content')
<div class="tabbable">
    <ul class="nav nav-tabs padding-18 tab-size-bigger" id="myTab">
        <li class="active">
            <a data-toggle="tab" href="#resume-tab-1" aria-expanded="false">
                <i class="blue ace-icon fa fa-hand-o-down bigger-120"></i>
                职位
            </a>
        </li>

        <li class="">
            <a data-toggle="tab" href="#resume-tab-2" aria-expanded="false">
                <i class="green ace-icon fa fa-cc bigger-120"></i>
                客户
            </a>
        </li>
    </ul>

    <div class="tab-content no-border padding-24">
        {{-- 职位信息--开始 --}}
        <div id="resume-tab-1" class="tab-pane fade active in">
            <h4 class="blue">
                <i class="blue ace-icon fa fa-hand-o-down bigger-110"></i>
                职位信息
            </h4>
            <div class="space-8"></div>

            <div class="profile-user-info profile-user-info-striped">
                <div class="profile-info-row">
                    <div class="profile-info-name"> 职位名称： </div>
                    <div class="profile-info-value">
                        <span class="editable editable-click" id="username" style="display: inline;">{{ $project->job->name }}</span>
                    </div>
                </div>
                <div class="profile-info-row">
                    <div class="profile-info-name"> 客户全称： </div>
                    <div class="profile-info-value">
                        <span class="editable editable-click" id="username" style="display: inline;">{{ $project->customer->name }}</span>
                    </div>
                </div>
                <div class="profile-info-row">
                    <div class="profile-info-name"> 招聘部门： </div>
                    <div class="profile-info-value">
                        <span class="editable editable-click" id="gender" style="display: inline;">{{ $project->job->department->name }}</span>
                    </div>
                </div>
                <div class="profile-info-row">
                    <div class="profile-info-name"> 任职要求(JD): </div>
                    <div class="profile-info-value">
                        <span class="editable editable-click" id="username" style="display: inline;">{!! $project->job->requirement !!}</span>
                    </div>
                </div>
                <div class="profile-info-row">
                    <div class="profile-info-name"> 总工作年限： </div>
                    <div class="profile-info-value">
                        <span class="editable editable-click" id="gender" style="display: inline;">{{ empty($project->job->workyears) ? '不限' : $project->job->workyears }}</span>
                    </div>
                </div>
                <div class="profile-info-row">
                    <div class="profile-info-name"> 性别要求： </div>
                    <div class="profile-info-value">
                        <span class="editable editable-click" id="mobile" style="display: inline;">{{ empty($project->job->gender) ? '不限' : $project->job->gender }}</span>
                    </div>
                </div>
                <div class="profile-info-row">
                    <div class="profile-info-name"> 专业要求： </div>
                    <div class="profile-info-value">
                        <span class="editable editable-click" id="email" style="display: inline;">{{ empty($project->job->majors) ? '不限' : $project->job->majors }}</span>
                    </div>
                </div>
                <div class="profile-info-row">
                    <div class="profile-info-name"> 学历要求： </div>
                    <div class="profile-info-value">
                        <span class="editable editable-click" id="degree" style="display: inline;">{{ empty($project->job->degree) ? '不限' : $project->job->degree }}</span>
                    </div>
                </div>

                <div class="profile-info-row">
                    <div class="profile-info-name"> 统招全日制： </div>

                    <div class="profile-info-value">
                        <span class="editable editable-click" id="birthdate">{{ $project->job->unified == '1' ? '是' : '否' }}</span>
                    </div>
                </div>

                <div class="profile-info-row">
                    <div class="profile-info-name"> 薪酬结构： </div>

                    <div class="profile-info-value">
                        <span class="editable editable-click" id="startworkdate">{!! $project->job->salary !!}</span>
                    </div>
                </div>
            </div>
        </div>
        {{-- 职位信息--结束 --}}

        {{-- 客户信息--开始 --}}
        <div id="resume-tab-2" class="tab-pane fade">
            <h4 class="green">
                <i class="green ace-icon fa fa-cc bigger-110"></i>
                客户信息
            </h4>

            <div class="space-8"></div>

            <div class="profile-user-info profile-user-info-striped">
                <div class="profile-info-row">
                    <div class="profile-info-name"> 公司全称： </div>
                    <div class="profile-info-value">
                        <span class="editable editable-click" id="username" style="display: inline;">{{ $project->customer->name }}</span>
                    </div>
                </div>
                <div class="profile-info-row">
                    <div class="profile-info-name"> 招聘部门： </div>
                    <div class="profile-info-value">
                        <span class="editable editable-click" id="gender" style="display: inline;"></span>
                    </div>
                </div>
                <div class="profile-info-row">
                    <div class="profile-info-name"> 工作地点： </div>
                    <div class="profile-info-value">
                        <i class="fa fa-map-marker light-orange bigger-110"></i>
                {{--         <a href="#" id="address" data-type="address" data-pk="1" data-title="Please, fill address" class="editable editable-click" data-original-title="" title=""><b>Moscow</b>, Lenina st., bld. 12</a> --}}
                        <span class="editable editable-click editable-unsaved" id="country" style="display: inline; background-color: rgba(0, 0, 0, 0);"></span>
                        <span class="editable editable-click editable-unsaved" style="display: inline; background-color: rgba(0, 0, 0, 0);" id="city"></span>
                        <span class="editable editable-click editable-unsaved" style="display: inline; background-color: rgba(0, 0, 0, 0);" id="county"></span>
                    </div>
                </div>
                <div class="profile-info-row">
                    <div class="profile-info-name"> 薪资福利： </div>
                    <div class="profile-info-value">
                        <span class="editable editable-click" id="email" style="display: inline;">{{ $project->customer->welfare }}</span>
                    </div>
                </div>
                <div class="profile-info-row">
                    <div class="profile-info-name"> 上班时间： </div>
                    <div class="profile-info-value">
                        <span class="editable editable-click" id="degree" style="display: inline;">{{ $project->customer->worktime }}</span>
                    </div>
                </div>

                <div class="profile-info-row">
                    <div class="profile-info-name"> 创始人： </div>

                    <div class="profile-info-value">
                        <span class="editable editable-click" id="birthdate">{{ $project->customer->founder }}</span>
                    </div>
                </div>

                <div class="profile-info-row">
                    <div class="profile-info-name"> 融资记录： </div>

                    <div class="profile-info-value">
                        <span class="editable editable-click" id="startworkdate">{{ $project->customer->financing }}</span>
                    </div>
                </div>

                <div class="profile-info-row">
                    <div class="profile-info-name"> 所属行业： </div>

                    <div class="profile-info-value">
                        <span class="editable editable-click" id="industry">{{ $project->customer->industry }}</span>
                    </div>
                </div>

                <div class="profile-info-row">
                    <div class="profile-info-name"> 行业排名： </div>

                    <div class="profile-info-value">
                        <span class="editable editable-click" id="ranking">{{ $project->customer->ranking }}</span>
                    </div>
                </div>

                <div class="profile-info-row">
                    <div class="profile-info-name"> 公司性质： </div>

                    <div class="profile-info-value">
                        <span class="editable editable-click" id="property">{{ $project->customer->property }}</span>
                    </div>
                </div>

                <div class="profile-info-row">
                    <div class="profile-info-name"> 公司规模： </div>

                    <div class="profile-info-value">
                        <span class="editable editable-click" id="size">{{ $project->customer->size }}</span>
                    </div>
                </div>

                <div class="profile-info-row">
                    <div class="profile-info-name"> 公司介绍： </div>

                    <div class="profile-info-value">
                        <span class="editable editable-click" id="introduce">{!! $project->customer->introduce !!}</span>
                    </div>
                </div>
            </div>
        </div>
        {{-- 客户信息--结束 --}}
   </div>
</div>
@endsection
