@extends('layouts.cici')

@section('title'){{ $title }}@endsection

@section('content')
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
                        <span class="editable editable-click" id="username" style="display: inline;">{{ $job->name }}</span>
                    </div>
                </div>
                <div class="profile-info-row">
                    <div class="profile-info-name"> 客户全称： </div>
                    <div class="profile-info-value">
                        <span class="editable editable-click" id="username" style="display: inline;">{{ $job->customer->name }}</span>
                    </div>
                </div>
                <div class="profile-info-row">
                    <div class="profile-info-name"> 招聘部门： </div>
                    <div class="profile-info-value">
                        <span class="editable editable-click" id="gender" style="display: inline;">{{ App\Department::name($job->did) }}</span>
                    </div>
                </div>
                <div class="profile-info-row">
                    <div class="profile-info-name"> 任职要求(JD): </div>
                    <div class="profile-info-value">
                        <span class="editable editable-click" id="username" style="display: inline;">{{ $job->requirement }}</span>
                    </div>
                </div>
                <div class="profile-info-row">
                    <div class="profile-info-name"> 总工作年限： </div>
                    <div class="profile-info-value">
                        <span class="editable editable-click" id="gender" style="display: inline;">{{ empty($job->workyears) ? '不限' : $job->workyears }}</span>
                    </div>
                </div>
                <div class="profile-info-row">
                    <div class="profile-info-name"> 性别要求： </div>
                    <div class="profile-info-value">
                        <span class="editable editable-click" id="mobile" style="display: inline;">{{ empty($job->gender) ? '不限' : $job->gender }}</span>
                    </div>
                </div>
                <div class="profile-info-row">
                    <div class="profile-info-name"> 专业要求： </div>
                    <div class="profile-info-value">
                        <span class="editable editable-click" id="email" style="display: inline;">{{ empty($job->majors) ? '不限' : $job->majors }}</span>
                    </div>
                </div>
                <div class="profile-info-row">
                    <div class="profile-info-name"> 学历要求： </div>
                    <div class="profile-info-value">
                        <span class="editable editable-click" id="degree" style="display: inline;">{{ empty($job->degree) ? '不限' : $job->degree }}</span>
                    </div>
                </div>

                <div class="profile-info-row">
                    <div class="profile-info-name"> 统招全日制： </div>

                    <div class="profile-info-value">
                        <span class="editable editable-click" id="birthdate">{{ $job->unified == '1' ? '是' : '否' }}</span>
                    </div>
                </div>

                <div class="profile-info-row">
                    <div class="profile-info-name"> 薪酬结构： </div>

                    <div class="profile-info-value">
                        <span class="editable editable-click" id="startworkdate">{{ $job->salary }}</span>
                    </div>
                </div>
            </div>
        </div>
        {{-- 职位信息--结束 --}}
   </div>
@endsection

@section('scripts')
<script type="text/javascript">
jQuery(function($) {

});
</script>
@endsection