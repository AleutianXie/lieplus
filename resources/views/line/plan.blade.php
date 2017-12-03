@extends('layouts.cici')

@section('title'){{ $title }}@endsection

@section('stylesheet')
<link rel="stylesheet" href="{{ asset('static/css/select2.min.css') }}" />
<link rel="stylesheet" href="{{ asset('static/css/ace.min.css') }}" />
<link rel="stylesheet" href="{{ asset('static/css/dataTables.bootstrap.min.css') }}" />
<link rel="stylesheet" href="{{ asset('static/css/bootstrap-editable.min.css') }}" />
<link rel="stylesheet" href="{{ asset('static/css/jquery-ui.min.css') }}" />
@endsection

@section('content')
@include('common.messages')

<div class="table-header">
    <div class="col-xs-10">
    工作台列表
    </div>
    <button class="btn btn-primary">
        <i class="ace-icon fa fa-plus-circle align-top bigger-125"></i>
            新增
    </button>
</div>
{{-- 交付工作台--开始 --}}
<div>
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
        @include('station.list', ['status' => 1, 'plan' => 1])
        </div>

        <div id="intention" class="tab-pane">
        @include('station.list', ['status' => 2, 'plan' => 1])
        </div>

        <div id="audit" class="tab-pane">
        @include('station.list', ['status' => 3, 'plan' => 1])
        </div>

        <div id="recommendation" class="tab-pane">
        @include('station.list', ['status' => 4, 'plan' => 1])
        </div>
        <div id="interview" class="tab-pane">
        @include('station.list', ['status' => 5, 'plan' => 1])
        </div>
        <div id="offer" class="tab-pane">
        @include('station.list', ['status' => 6, 'plan' => 1])
        </div>
        <div id="onboard" class="tab-pane">
        @include('station.list', ['status' => 7, 'plan' => 1])
        </div>
    </div>
</div>
</div>
<div id="add-dialog" class="row hide">
    <form class="form-horizontal" id="validation-form" method="post" action="/plan/add">
    <div class="form-group text-center">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <select name="lid" id="lid">
            <option></option>
            @foreach ($lines as $line)
            <option value="{{ $line->id }}">{{ $line->sn }} - {{ $line->job->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group text-center">
        <button class="btn btn-primary" type="submit">
        <i class="ace-icon fa fa-plus-circle"></i>
        提交
        </button>
    </div>
    </form>
</div>
{{-- 交付工作台--结束 --}}
@endsection

@section('breadcrumbs')
{!! Breadcrumbs::render('line.plan') !!}
@endsection

@section('scripts')
<script src="{{ asset('static/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('static/js/jquery.dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('static/js/select2.min.js') }}"></script>
<script src="{{ asset('static/js/jquery.hotkeys.index.min.js') }}"></script>
<script src="{{ asset('static/js/ace.min.js') }}"></script>
<script src="{{ asset('static/js/ace-elements.min.js') }}"></script>
<script src="{{ asset('static/js/bootstrap-editable.min.js') }}"></script>
<script src="{{ asset('static/js/ace-editable.min.js') }}"></script>
<script src="{{ asset('static/js/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('static/js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('static/js/jquery.ui.touch-punch.min.js') }}"></script>
<script src="{{ asset('static/js/jquery.form.min.js') }}"></script>

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
                ajax: '/plan/stations/'+ status,
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
                            if(!data)
                            {
                                data = '新增反馈';
                            }
                            return "<span class='editable editable-click' id='feedback[" + row.resume.id + "]' data-name='text' data-emptytext='新增反馈' data-type='text' data-url='/resume/feedback' data-pk='"+row.resume.id+"'>"+data +"</span>";
                        }
                    },
                    {data: 'recruiter'},
                    {data: 'name'},
                    {
                        data: null,
                        render: function(data, type, row){
                            if (row.line.job.closed == 0) {
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
                                            btnGHtml += "<li>" + "<a href='#' id='create-" + row.resume.id + "' data-lid='" + row.lid + "'>" +
                                            "<i class='blue ace-icon fa fa-plus-square bigger-120'></i>" +
                                            " 加入工作台 </a></li>";
                                        @endrole
                                    }
                                    if (status == 1 || status == 2){
                                        @role('admin|recruiter')
                                            btnGHtml += "<li><a href='{{ asset('/resume/') }}/" + row.resume.id + "#resume-tab-4') }}'>" +
                                            "<i class='blue ace-icon fa fa-bell-o bigger-120'></i> 提醒 </a></li>";
                                            btnGHtml += "<li><a href='#' id='next-" + row.resume.id + "' data-lid='" + row.lid + "'>" +
                                            "<i class='blue ace-icon fa fa-arrow-right bigger-120'></i>" +
                                                " 下一步 </a>" +
                                            "</li>";
                                            btnGHtml += "<li><a href='#' id='abandon-" + row.resume.id + "' data-lid='" + row.lid + "'>" +
                                                "<i class='blue ace-icon fa fa-remove bigger-120'></i>" +
                                                    " 放弃 </a>" +
                                                "</li>";
                                        @endrole
                                    }
                                    if (status == 3 || status == 4 || status == 5 || status == 6)
                                    {
                                        @role('admin|customer|manager')
                                            btnGHtml += "<li><a href='{{ asset('/resume/') }}/" + row.resume.id + "#resume-tab-4') }}'>" +
                                            "<i class='blue ace-icon fa fa-bell-o bigger-120'></i> 提醒 </a></li>";
                                            btnGHtml += "<li><a href='#' id='next-" + row.resume.id + "' data-lid='" + row.lid + "'>" +
                                            "<i class='blue ace-icon fa fa-arrow-right bigger-120'></i>" +
                                                " 下一步 </a>" +
                                            "</li>";
                                            btnGHtml += "<li><a href='#' id='abandon-" + row.resume.id + "' data-lid='" + row.lid + "'>" +
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
                                    if (status == 7)
                                    {
                                        @role('admin|customer|manager')
                                            btnGHtml += "<li><a href='{{ asset('/resume/') }}/" + row.resume.id + "#resume-tab-4') }}'>" +
                                            "<i class='blue ace-icon fa fa-bell-o bigger-120'></i> 提醒 </a></li>";
                                            btnGHtml += "<li><a href='#' id='abandon-" + row.resume.id + "' data-lid='" + row.lid + "'>" +
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
                            }
                            else
                            {
                                btnGHtml = "<span class='label label-info arrowed-in arrowed-in-right'>已暂停</span>";
                            }
                            return btnGHtml;
                        }
                    }
                ]
            });
        });



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

        $('table.table tbody').on('click','a[id^=next]', function (e) {
            var rid = $(this)[0].id.substring(5);
            var lid = $(this)[0].dataset.lid;
            var status = parseInt($(this).parents('table')[0].dataset.status);
            var next = parseInt(status) + 1;

            $.ajax({
                type: 'post',
                url: '{{ url('/station/next/')}}/' + lid + '/' + rid,
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
            var lid = $(this)[0].dataset.lid;
            var status = parseInt($(this).parents('table')[0].dataset.status);
            $.ajax({
                type: 'post',
                url: '{{ url('/station/abandon/')}}/' + lid + '/' + rid,
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
            var lid = $(this)[0].dataset.lid;
            var status = parseInt($(this).parents('table')[0].dataset.status);
            $.ajax({
                type: 'post',
                url: '{{ url('/station/reactive/')}}/' + lid + '/' + rid,
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
            var lid = $(this)[0].dataset.lid;
            var status = parseInt($(this).parents('table')[0].dataset.status);
            $.ajax({
                type: 'post',
                url: '{{ url('/station/create/')}}/' + lid + '/'  + rid,
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

        $('button.btn-primary').on('click', function (e){
            $("#add-dialog").removeClass('hide').dialog({
                modal: true,
                title: "新增今日工作台",
                width: '50%',
                resizable: false
            });
        });
        $('#lid').select2({
            placeholder: "请选择职位流水线",
            width: 340
        });
        $('#add-dialog').ajaxForm({
            beforeSubmit:function(){
                var lid = $("select[name=lid]").val();
                if(lid == ''){
                    swal({
                        title: '新增今日工作台',
                        text: '请选择职位流水线',
                        type: 'error',
                        allowOutsideClick: false,
                    });
                    return false;
                }
            },
            success:function(response) {
                var data = $.parseJSON(response);
                var type = data['code'] == 0 ? 'success' : 'error';
                swal({
                    title: '新增今日工作台',
                    text: data['msg'],
                    type: type,
                    allowOutsideClick: false,
                });
                dt[1].draw(false);
                dt[2].draw(false);
                dt[3].draw(false);
                dt[4].draw(false);
                dt[5].draw(false);
                dt[6].draw(false);
                dt[7].draw(false);
                $('#add-dialog').dialog('close');
            }
        });
    });

</script>
@endsection