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
            ordering: false,
            createdRow: function (row, data, dataIndex)
            {
                if(data.closed == 0)
                {
                    $(row).addClass('success');
                }
            },
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
                {
                    data:null,
                    render: function (data, type, row)
                    {
                        return "<a href='#'>总共 <span class='badge'>" + row.jobCount + "</span> 其中open <span class='badge'>" + row.openCount + "</span>; closed<span class='badge'>" + row.closedCount + "</span> </a>"
                    }
                },
                {data: 'level'},
                {data: 'property'},
                {
                    data: null,
                    render: function (data, type, row)
                    {
                        var ret = '';
                        if (row.assigned)
                        {
                            ret = row.assigned.adviser.name;
                        }
                        return ret;
                    }
                },
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
                            if (!row.assigned)
                            {
                                btnGHtml += "<li>" + "<a href='/customer/assignmodal/" + row.id + "' data-toggle='modal' data-target='#assign-dialog'>" +
                                "<i class='blue ace-icon fa fa-hand-lizard-o bigger-120'></i>" +
                                    " 分配客户顾问 </a>"+
                                    "</li>";
                            }
                            else
                            {
                                btnGHtml += "<li>" + "<a href='/customer/assignmodal/" + row.id + "/" + row.assigned.adviser.id + "' data-toggle='modal' data-target='#assign-dialog'>" +
                                "<i class='blue ace-icon fa fa-hand-scissors-o bigger-120'></i>" +
                                    " 更换客户顾问 </a>"+
                                    "</li>";
                            }
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
                    dt.draw(false);
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
                    dt.draw(false);
                },
            });
        });

        @role('admin|manager')
        $("#assign-dialog").on("show.bs.modal", function(e) {
            var btn = $(e.relatedTarget),
            cid = btn.data("cid");
            $("#assign-dialog input[name=cid]").val(cid);
        })

        $('#assign-dialog').on('loaded.bs.modal', function () {
            $('#uid').select2({
                placeholder: "请选择客户顾问",
                width: 330
            });
        });

        $('#assign-dialog').on('hide.bs.modal', function () {
            $(this).removeData("bs.modal");
            $(".modal-content").children().remove();
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
                dt.draw(false);
                $('#assign-dialog').modal('hide');
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
                        <th>等级</th>
                        <th>公司类型</th>
                        <th>客户顾问</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
        <!-- 客户列表--结束 -->
    </div>
</div>

{{-- 分配客户顾问 --}}
<div class="modal fade" id="assign-dialog" tabIndex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
        </div>
    </div>
</div>
<!-- PAGE CONTENT ENDS -->
</div><!-- /.col -->
</div>



