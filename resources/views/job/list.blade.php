<link rel="stylesheet" href="{{ asset('static/css/bootstrap-editable.min.css') }}" />
<link rel="stylesheet" href="{{ asset('static/css/select2.min.css') }}" />
<link rel="stylesheet" href="{{ asset('static/css/ace.min.css') }}" />
<link rel="stylesheet" href="{{ asset('static/css/dataTables.bootstrap.min.css') }}" />

<!-- page specific plugin scripts -->
<script src="{{ asset('static/js/jquery-2.1.4.min.js') }}"></script>
<script src="{{ asset('static/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('static/js/jquery.dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('static/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('static/js/buttons.flash.min.js') }}"></script>
<script src="{{ asset('static/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('static/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('static/js/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('static/js/dataTables.select.min.js') }}"></script>
<script src="{{ asset('static/js/bootstrap-editable.min.js') }}"></script>
<script src="{{ asset('static/js/sweetalert2.all.min.js') }}"></script>
<!-- inline scripts related to this page -->
<script type="text/javascript">
    $(document).ready(function(){
        var dt = $('#dynamic-table').DataTable({
            language: {
                url: '{{ asset('static/localisation/Chinese.json') }}'
            },
            processing: true,
            serverSide: true,
            ajax: '{{ route('job.search', $type) }}',
            columns:
            [
                {
                    data: 'sn',
                    render: function (data, type, row )
                    {
                        return "<a href='{{ asset('/job')}}/" + row.id+ "'>" + data +"</a>";
                    }
                },
                {data: 'customer.name'},
                {data: 'name'},
                {
                    data: 'workyears',
                    defaultContent: '不限',
                    render: function (data, type, row)
                    {
                        if(data == '')
                        {
                            data = '不限';
                        }
                        return data;
                    }
                },
                {
                    data: 'gender',
                    defaultContent: '不限',
                    render: function (data, type, row)
                    {
                        if(data == '')
                        {
                            data = '不限';
                        }
                        return data;
                    }
                },
                {
                    data: 'majors',
                    defaultContent: '不限',
                    render: function (data, type, row)
                    {
                        if(data == '')
                        {
                            data = '不限';
                        }
                        return data;
                    }
                },
                {
                    data: 'degree',
                    defaultContent: '不限',
                    render: function (data, type, row)
                    {
                        if(data == '')
                        {
                            data = '不限';
                        }
                        return data;
                    }
                },
                {
                    data: 'unified',
                    defaultContent: '是',
                    render: function (data, type, row)
                    {
                        return data == 1 ? '是' : '否';
                    }
                },
                {
                    data: null,
                    render: function(data, type, row){
                        if('通过' === row.customer.project.status) {
                            var btnGHtml = "<div class='dropdown'>" +
                            "<a data-toggle='dropdown' class='dropdown-toggle' href='#' aria-expanded='false'>" +
                                "<i class='purple ace-icon fa fa-asterisk bigger-120'></i>" +
                                    " 操作<i class='ace-icon fa fa-caret-down'></i></a>" +
                                        "<ul class='dropdown-menu dropdown-lighter dropdown-125 pull-right'>" +
                                            "<li>" +
                                                "<a href='{{ asset('/job') }}/" + row.id + "'>"+
                                                "<i class='blue ace-icon fa fa-eye bigger-120'></i> 查看 </a>" +
                                            "</li>";
                            if (row.closed == 0) {
                                btnGHtml += "<li>" + "<a href='#' id='pause-" + row.id + "'>" +
                                                "<i class='blue ace-icon fa fa-pause bigger-120'></i>" +
                                                   " 暂停 </a>"+
                                             "</li>";
                            }
                            else {
                                btnGHtml += "<li>" + "<a href='#' id='reopen-" + row.id + "'>" +
                                                "<i class='blue ace-icon fa fa-refresh bigger-120'></i>" +
                                                   " 重新发布 </a>" +
                                             "</li>";
                            }
                            btnGHtml += "</ul></div>";
                        }
                        else {
                            btnGHtml = "<span class='label label-info arrowed-in arrowed-in-right'>项目 " + row.project.status + "</span>";
                        }
                        return btnGHtml;
                    }
                }
            ]
        });

        $('table.table tbody').on('click','a[id^=pause-]', function (e) {
            var jid = $(this)[0].id.substring(6);
            $.ajax({
                type: 'post',
                url: '{{ url('/job/pause/')}}/' + jid,
                data: { '_token' : '{{ csrf_token() }}' },
                success: function(response){
                    var data = $.parseJSON(response);
                    var type = data['code'] == 0 ? 'success' : 'error';
                    swal({
                        title: '暂停',
                        text: data['msg'],
                        type: type,
                        allowOutsideClick: false,
                    });
                    dt.ajax.reload();
                },
            });
        });

        $('table.table tbody').on('click','a[id^=reopen-]', function (e) {
            var jid = $(this)[0].id.substring(7);
            $.ajax({
                type: 'post',
                url: '{{ url('/job/open/')}}/' + jid,
                data: { '_token' : '{{ csrf_token() }}' },
                success: function(response){
                    var data = $.parseJSON(response);
                    var type = data['code'] == 0 ? 'success' : 'error';
                    swal({
                        title: '重新发布',
                        text: data['msg'],
                        type: type,
                        allowOutsideClick: false,
                    });
                    dt.ajax.reload();
                },
            });
        });
    });
</script>

<div class="row">
<div class="col-xs-12">
<!-- PAGE CONTENT BEGINS -->
<div class="row">
    <div class="col-xs-12">
{{--         <h3 class="header smaller lighter blue">jQuery dataTables</h3>

        <div class="clearfix">
            <div class="pull-right tableTools-container"></div>
        </div> --}}
        <div class="table-header">
            职位列表
        </div>

        <!-- 客户列表--开始 -->
        <div>
            <table id='dynamic-table' class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>编号</th>
                        <th>客户全称</th>
                        <th>职位名称</th>
                        <th>工作年限</th>
                        <th>性别</th>
                        <th>专业</th>
                        <th>学历</th>
                        <th>是否统招</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
{{--                     <tr>
                        <td><a href="{{ asset('/job/'.$job->id) }}">{{ $job->sn }}</a></td>
                        <td>{{ $job->customer->name }}</td>
                        <td>{{ $job->name }}</td>
                        <td>{{ $job->workyears != '' ? $job->workyears : '不限' }}</td>
                        <td>{{ $job->gender != '' ? $job->gender : '不限' }}</td>
                        <td>{{ $job->majors != '' ? $job->majors : '不限' }}</td>
                        <td>{{ $job->degree != '' ? $job->degree : '不限' }}</td>
                        <td>{{ $job->unified == 1 ? '是' : '否' }}</td>
                        <td>
                            <div class="dropdown">
                                <a data-toggle="dropdown" class="dropdown-toggle" href="#" aria-expanded="false">
                                    <i class="purple ace-icon fa fa-asterisk bigger-120"></i>
                                    操作
                                    <i class="ace-icon fa fa-caret-down"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-lighter dropdown-125 pull-right">
                                    <li>
                                        <a href="{{ asset('/job/'.$job->id) }}">
                                        <i class="blue ace-icon fa fa-eye bigger-120"></i>
                                         查看 </a>
                                    </li> --}}
{{--                                     <li>
                                        <a href="#">
                                        <i class="blue ace-icon fa fa-plus-square bigger-120"></i>
                                         加入职位简历库 </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                        <i class="blue ace-icon fa fa-plus-circle bigger-120"></i>
                                         重新加入工作台 </a>
                                    </li> --}}
{{--                                 </ul>
                            </div>
                        </td>
                    </tr> --}}
                </tbody>
            </table>
        </div>
        <!-- 客户列表--结束 -->
    </div>
</div>

<!-- PAGE CONTENT ENDS -->
</div><!-- /.col -->
</div>



