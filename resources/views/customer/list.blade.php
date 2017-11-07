<link rel="stylesheet" href="{{ asset('static/css/bootstrap-editable.min.css') }}" />
<link rel="stylesheet" href="{{ asset('static/css/ace.min.css') }}" />
<link rel="stylesheet" href="{{ asset('static/css/dataTables.bootstrap.min.css') }}" />
<link rel="stylesheet" href="{{ asset('static/css/select2.min.css') }}" />

<!-- page specific plugin scripts -->
<script src="{{ asset('static/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('static/js/jquery.dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('static/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('static/js/buttons.flash.min.js') }}"></script>
<script src="{{ asset('static/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('static/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('static/js/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('static/js/dataTables.select.min.js') }}"></script>
<script src="{{ asset('static/js/bootstrap-editable.min.js') }}"></script>
<script src="{{ asset('static/js/jquery.form.min.js') }}"></script>
<script src="{{ asset('static/js/select2.min.js') }}"></script>
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
            ajax: '{{ route('customer.search', $type) }}',
            columns: [
                {
                    data: 'sn',
                    render: function (data, type, row )
                    {
                        return "<a href='{{ asset('/customer')}}/" + row.id+ "'>" + data +"</a>";
                    }
                },
                {data: 'name', defaultContent: ''},
                {data: 'industry', defaultContent: ''},
                {data: 'jobCount', defaultContent: '0'},
                {data: 'openCount', defaultContent: '0'},
                {data: 'closedCount', defaultContent: '0'},
                {data: 'level'},
                {data: 'property'},
                {
                    data: null,
                    render: function(data, type, row){
                        if('通过' === row.project.status) {
                            var btnGHtml = "<div class='dropdown'>" +
                            "<a data-toggle='dropdown' class='dropdown-toggle' href='#' aria-expanded='false'>" +
                                "<i class='purple ace-icon fa fa-asterisk bigger-120'></i>" +
                                    " 操作<i class='ace-icon fa fa-caret-down'></i></a>" +
                                        "<ul class='dropdown-menu dropdown-lighter dropdown-125 pull-right'>" +
                                            "<li>" +
                                                "<a href='{{ asset('/customer') }}/" + row.id + "'>"+
                                                "<i class='blue ace-icon fa fa-eye bigger-120'></i> 查看 </a>" +
                                            "</li>";
                            @role('admin|manager')
                            btnGHtml += "<li>" + "<a href='#' data-toggle='modal' data-target='#assign-dialog' data-cid='" + row.id + "'>" +
                            "<i class='blue ace-icon fa fa-hand-lizard-o bigger-120'></i>" +
                                " 分配客户顾问 </a>"+
                                "</li>";
                            @endrole

                            @role('customer')
                                if (row.ismine == 1 && row.closed == 0) {
                                    btnGHtml += "<li>" + "<a href='#' id='pause-" + row.id + "'>" +
                                    "<i class='blue ace-icon fa fa-pause bigger-120'></i>" +
                                        " 暂停合作 </a>" +
                                    "</li>";
                                }
                                btnGHtml += "<li>" + "<a href='/job/add?cid=" + row.id + "'>" +
                                "<i class='blue ace-icon fa fa-plus-circle bigger-120'></i>" +
                                    " 增加职位 </a>" +
                                "</li>";
                            @endrole

                            @role('admin|manager')
                                if (row.closed == 0) {
                                    btnGHtml += "<li>" + "<a href='#' id='pause-" + row.id + "'>" +
                                    "<i class='blue ace-icon fa fa-pause bigger-120'></i>" +
                                        " 暂停合作 </a>" +
                                    "</li>";
                                }
                                else {
                                    btnGHtml += "<li>" + "<a href='#' id='reopen-" + row.id + "'>" +
                                    "<i class='blue ace-icon fa fa-play bigger-120'></i>" +
                                        " 重启合作 </a>" +
                                    "</li>";
                                }
                                btnGHtml += "<li>" + "<a href='/job/add?cid=" + row.id + "'>" +
                                "<i class='blue ace-icon fa fa-plus-circle bigger-120'></i>" +
                                    " 增加职位 </a>" +
                                "</li>";
                            @endrole
                            btnGHtml += "</ul></div>";
                        }
                        else
                        {
                            btnGHtml = "<span class='label label-info arrowed-in arrowed-in-right'>" + row.project.status + "</span>"
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
                url: '{{ url('/customer/pause/')}}/' + jid,
                data: { '_token' : '{{ csrf_token() }}' },
                success: function(response){
                    var data = $.parseJSON(response);
                    var type = data['code'] == 0 ? 'success' : 'error';
                    swal({
                        title: '暂停合作',
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
                url: '{{ url('/customer/open/')}}/' + jid,
                data: { '_token' : '{{ csrf_token() }}' },
                success: function(response){
                    var data = $.parseJSON(response);
                    var type = data['code'] == 0 ? 'success' : 'error';
                    swal({
                        title: '重启合作',
                        text: data['msg'],
                        type: type,
                        allowOutsideClick: false,
                    });
                    dt.ajax.reload();
                },
            });
        });

        @role('admin|manager')
        $("#assign-dialog").on("show.bs.modal", function(e) {
            var btn = $(e.relatedTarget),
            cid = btn.data("cid");
            $("#assign-dialog input[name=cid]").val(cid);
        })
        $('#uid').select2({
            placeholder: "请选择客户顾问",
            width: 330
        });
        $('#assign-dialog').ajaxForm({
            beforeSubmit:function(){
                var uid = $("select[name=uid]").val();
                if(uid == ''){
                    swal({
                        title: '分配客户顾问',
                        text: '请选择客户顾问',
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
                    title: '分配客户顾问',
                    text: data['msg'],
                    type: type,
                    allowOutsideClick: false,
                });
                dt.ajax.reload();
            }
        });
        @endrole
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
            客户列表
        </div>

        <!-- 客户列表--开始 -->
        <div>
            <table id='dynamic-table' class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>编号</th>
                        <th>公司名称</th>
                        <th>行业</th>
                        <th>职位数</th>
                        <th>Open</th>
                        <th>Closed</th>
                        <th>等级</th>
                        <th>公司类型</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
{{--                     <tr>
                        <td><a href="{{ asset('/customer/'.$customer->id) }}"> {{ $customer->sn }}</a></td>
                        <td>{{ $customer->name }}</td>
                        <td>{{ count($customer->job) }}</td>
                        <td>{{ $customer->mobile }}</td>
                        <td>{{ $customer->email }}</td>
                        <td>{{ $customer->level }}</td>
                        <td>{{ $customer->property }}</td>
                        <td>
                            <div class="dropdown">
                                <a data-toggle="dropdown" class="dropdown-toggle" href="#" aria-expanded="false">
                                    <i class="purple ace-icon fa fa-asterisk bigger-120"></i>
                                    操作
                                    <i class="ace-icon fa fa-caret-down"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-lighter dropdown-125 pull-right">
                                    <li>
                                        <a href="{{ asset('/customer/'.$customer->id) }}">
                                        <i class="blue ace-icon fa fa-eye bigger-120"></i>
                                         查看 </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                        <i class="blue ace-icon fa fa-play bigger-120"></i>
                                         分配 </a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr> --}}
                </tbody>
            </table>
        </div>
        <!-- 客户列表--结束 -->
    </div>
</div>

{{-- 加入简历库 --}}
<div class="modal fade" id="assign-dialog" tabIndex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                ×
                </button>
                <h4 class="modal-title">分配客户顾问</h4>
            </div>
            <div class="modal-body">
                <form  method="POST" action="{{ route('customer.assign') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="cid" id="cid" value="">
                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-2 no-padding-right" for="jid">职位简历库:</label>
                        <div class="col-xs-6 col-sm-6">
                            <div class="clearfix">
                                <select name="uid" id="uid">
                                <option></option>
                                @isset ($users)
                                <option></option>
                                @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                                @endisset
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-success btn-xs">
                            <i class="ace-icon fa fa-plus bigger-125"></i> 加入
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- PAGE CONTENT ENDS -->
</div><!-- /.col -->
</div>



