@extends('layouts.cici')

@section('stylesheet')
<link rel="stylesheet" href="{{ asset('static/css/select2.min.css') }}" />
<link rel="stylesheet" href="{{ asset('static/css/bootstrap-datepicker3.min.css') }}" />
<link rel="stylesheet" href="{{ asset('static/css/bootstrap-editable.min.css') }}" />
<link rel="stylesheet" href="{{ asset('static/css/ace.min.css') }}" />
<link rel="stylesheet" href="{{ asset('static/css/dataTables.bootstrap.min.css') }}" />
@endsection

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
                            <div class="profile-info-name"> 审批中： </div>
                            <div class="profile-info-value">
                                <span class="editable editable-click" id="username" style="display: inline;">{{ count($line->audit) }}</span>
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
                        <span class="editable editable-click" id="gender" style="display: inline;">{{ $line->job->department->name }}</span>
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

            @include('station.list', ['status' => 0])

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
                                                    <a data-toggle="tab" href="#audit">
                                                        <i class="grey ace-icon fa fa-arrow-down bigger-110"></i>
                                                        审批中
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
                                                @include('station.list', ['status' => 1])
                                                </div>

                                                <div id="intention" class="tab-pane">
                                                @include('station.list', ['status' => 2])
                                                </div>

                                                <div id="audit" class="tab-pane">
                                                @include('station.list', ['status' => 3])
                                                </div>

                                                <div id="recommendation" class="tab-pane">
                                                @include('station.list', ['status' => 4])
                                                </div>
                                                <div id="interview" class="tab-pane">
                                                @include('station.list', ['status' => 5])
                                                </div>
                                                <div id="offer" class="tab-pane">
                                                @include('station.list', ['status' => 6])
                                                </div>
                                                <div id="onboard" class="tab-pane">
                                                @include('station.list', ['status' => 7])
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
<script src="{{ asset('static/js/sweetalert2.all.min.js') }}"></script>

<!-- inline scripts related to this page -->


<script type="text/javascript">
    //editables on first profile page
    $.fn.editable.defaults.mode = 'inline';
    $(document).ready(function(){
        var dt=[];

        $('table.table').each(function(){
                var status = $(this)[0].dataset.status;
                dt[status] = $(this).DataTable({
                    language: {
                    url: '{{ asset('static/localisation/Chinese.json') }}'
                },
                processing: true,
                serverSide: true,
                ajax: '/line/stations/{{ $line->id }}/'+ status,
                ordering: false,
                columns: [
                    {
                        data: 'resume.sn',
                        render: function (data, type, row )
                        {
                            return "<a href='{{ asset('/resume')}}/" + row.resume.id+ "'>" + data +"</a>";
                        }
                    },
                    {data: 'resume.name'},
                    {data: null, defaultContent: '摘要'},
                    {data: 'resume.mobile'},
                    {data: 'resume.email'},
                    {
                        data: 'resume.feedback',
                        defaultContent: '新增反馈',
                        render: function (data, type, row)
                        {
                            @if ($line->job->closed == 0)
                            if(!data)
                            {
                                data = '新增反馈';
                            }
                            return "<span class='editable editable-click' id='feedback[" + row.resume.id + "]' data-name='text' data-emptytext='新增反馈' data-type='text' data-url='/resume/feedback' data-pk='"+row.resume.id+"'>"+data +"</span>";
                            @else
                            return data;
                            @endif
                        }
                    },
                    {data: 'recruiter'},
                    {
                        data: null,
                        render: function(data, type, row){
                            @if ($line->job->closed == 0)
                            var btnGHtml = "<div class='dropdown'>" +
                            "<a data-toggle='dropdown' class='dropdown-toggle' href='#' aria-expanded='false'>" +
                                "<i class='purple ace-icon fa fa-asterisk bigger-120'></i>" +
                                    "操作<i class='ace-icon fa fa-caret-down'></i></a>" +
                                        "<ul class='dropdown-menu dropdown-lighter dropdown-125 pull-right'>" +
                                "<li>" +
                                    "<a href='{{ asset('/resume') }}/" + row.resume.id + "'>"+
                                        "<i class='blue ace-icon fa fa-eye bigger-120'></i> 查看 </a>" +
                                "</li>";
                                if (status == 0){
                                    @role('admin|recruiter')
                                        btnGHtml += "<li><a href='{{ asset('/resume/') }}/" + row.resume.id + "#resume-tab-4') }}'>" +
                                            "<i class='blue ace-icon fa fa-bell-o bigger-120'></i> 提醒 </a></li>";
                                        btnGHtml += "<li>" + "<a href='#' id='create-" + row.resume.id + "'>" +
                                        "<i class='blue ace-icon fa fa-plus-square bigger-120'></i>" +
                                        " 加入工作台 </a></li>";
                                    @endrole
                                }
                                if (status == 1 || status == 2){
                                    @role('admin|recruiter')
                                        btnGHtml += "<li><a href='{{ asset('/resume/') }}/" + row.resume.id + "#resume-tab-4') }}'>" +
                                        "<i class='blue ace-icon fa fa-bell-o bigger-120'></i> 提醒 </a></li>";
                                        btnGHtml += "<li><a href='#' id='next-" + row.resume.id + "'>" +
                                        "<i class='blue ace-icon fa fa-arrow-right bigger-120'></i>" +
                                            " 下一步 </a>" +
                                        "</li>";
                                        btnGHtml += "<li><a href='#' id='abandon-" + row.resume.id + "'>" +
                                            "<i class='blue ace-icon fa fa-remove bigger-120'></i>" +
                                                " 放弃 </a>" +
                                            "</li>";
                                    @endrole
                                }
                                if (status == 3 || status == 4 || status == 5 || status == 6)
                                {
                                    @role('admin|customer|manager')
                                        if(row.line.is_mine_customer == 1){
                                            btnGHtml += "<li><a href='{{ asset('/resume/') }}/" + row.resume.id + "#resume-tab-4') }}'>" +
                                            "<i class='blue ace-icon fa fa-bell-o bigger-120'></i> 提醒 </a></li>";
                                            btnGHtml += "<li><a href='#' id='next-" + row.resume.id + "'>" +
                                            "<i class='blue ace-icon fa fa-arrow-right bigger-120'></i>" +
                                                " 下一步 </a>" +
                                            "</li>";
                                            btnGHtml += "<li><a href='#' id='abandon-" + row.resume.id + "'>" +
                                                "<i class='blue ace-icon fa fa-remove bigger-120'></i>" +
                                                    " 放弃 </a>" +
                                                "</li>";
                                        }
                                    @else
                                        @role('recruiter')
                                        if(row.ismine == 1){
                                            btnGHtml += "<li><a href='{{ asset('/resume/') }}/" + row.resume.id + "#resume-tab-4') }}'>" +
                                            "<i class='blue ace-icon fa fa-bell-o bigger-120'></i> 提醒 </a></li>";

                                            btnGHtml += "<li><a href='#' id='abandon-" + row.resume.id + "'>" +
                                                "<i class='blue ace-icon fa fa-remove bigger-120'></i>" +
                                                    " 放弃 </a>" +
                                                "</li>";
                                        }
                                        @endrole
                                    @endrole
                                }
                                if (status == 7)
                                {
                                    @role('admin|customer|manager')
                                        btnGHtml += "<li><a href='{{ asset('/resume/') }}/" + row.resume.id + "#resume-tab-4') }}'>" +
                                        "<i class='blue ace-icon fa fa-bell-o bigger-120'></i> 提醒 </a></li>";
                                        btnGHtml += "<li><a href='#' id='abandon-" + row.resume.id + "'>" +
                                            "<i class='blue ace-icon fa fa-remove bigger-120'></i>" +
                                                " 放弃 </a>" +
                                            "</li>";
                                        btnGHtml += "<li><a href='#' id='abandon-" + row.resume.id + "'>" +
                                                "<i class='blue ace-icon fa fa-remove bigger-120'></i>" +
                                                    " 放弃 </a>" +
                                                "</li>";
                                    @else
                                        @role('recruiter')
                                        if(row.ismine == 1){
                                            btnGHtml += "<li><a href='{{ asset('/resume/') }}/" + row.resume.id + "#resume-tab-4') }}'>" +
                                            "<i class='blue ace-icon fa fa-bell-o bigger-120'></i> 提醒 </a></li>";
                                        }
                                        @endrole
                                    @endrole
                                }

                            btnGHtml += "</ul></div>";
                            @else
                            btnGHtml = "<span class='label label-info arrowed-in arrowed-in-right'>已暂停</span>";
                            @endif
                            return btnGHtml;
                        }
                    }
                ]
            });
        });

        @if ($line->job->closed == 0)
        $('table.table tbody').on('click','span[id^=feedback]', function (e) {
            $(this).editable({
                params: {'_token' : '{{ csrf_token() }}'},
                validate: function(value) {
                    if($.trim(value) == '') {
                        return '反馈不能为空！';
                    }
                }
            });
        });
        @endif

        $('table.table tbody').on('click','a[id^=next]', function (e) {
            var rid = $(this)[0].id.substring(5);
            var status = parseInt($(this).parents('table')[0].dataset.status);
            var next = status + 1;

            $.ajax({
                type: 'post',
                url: '{{ url('/station/next/'.$line->id)}}/' + rid,
                data: { '_token' : '{{ csrf_token() }}' },
                success: function(response){
                    var data = $.parseJSON(response);
                    var type = data['code'] == 0 ? 'success' : 'error';
                    swal({
                        title: '下一步',
                        text: data['msg'],
                        type: type,
                        allowOutsideClick: false,
                    });
                    dt[status].draw(false);
                    dt[next].draw(false);
                },
            });
        });

        $('table.table tbody').on('click','a[id^=abandon]', function (e) {
            var rid = $(this)[0].id.substring(8);
            var status = parseInt($(this).parents('table')[0].dataset.status);
            $.ajax({
                type: 'post',
                url: '{{ url('/station/abandon/'.$line->id)}}/' + rid,
                data: { '_token' : '{{ csrf_token() }}' },
                success: function(response){
                    var data = $.parseJSON(response);
                    var type = data['code'] == 0 ? 'success' : 'error';
                    swal({
                        title: '放弃',
                        text: data['msg'],
                        type: type,
                        allowOutsideClick: false,
                    });
                    dt[status].draw(false);
                },
            });
        });

        $('table.table tbody').on('click','a[id^=reactive]', function (e) {
            var rid = $(this)[0].id.substring(9);
            var status = parseInt($(this).parents('table')[0].dataset.status);
            $.ajax({
                type: 'post',
                url: '{{ url('/station/reactive/'.$line->id)}}/' + rid,
                data: { '_token' : '{{ csrf_token() }}' },
                success: function(response){
                    var data = $.parseJSON(response);
                    var type = data['code'] == 0 ? 'success' : 'error';
                    swal({
                        title: '重新加入工作台',
                        text: data['msg'],
                        type: type,
                        allowOutsideClick: false,
                    });
                    dt[status].draw(false);
                    dt[1].draw(false);
                },
            });
        });

        $('table.table tbody').on('click','a[id^=create]', function (e) {
            var rid = $(this)[0].id.substring(7);
            var status = parseInt($(this).parents('table')[0].dataset.status);
            $.ajax({
                type: 'post',
                url: '{{ url('/station/create/'.$line->id)}}/' + rid,
                data: { '_token' : '{{ csrf_token() }}' },
                success: function(response){
                    var data = $.parseJSON(response);
                    var type = data['code'] == 0 ? 'success' : 'error';
                    swal({
                        title: '加入工作台',
                        text: data['msg'],
                        type: type,
                        allowOutsideClick: false,
                    });
                    dt[status].draw(false);
                    dt[1].draw(false);
                },
            });
        });
    });

</script>
@endsection