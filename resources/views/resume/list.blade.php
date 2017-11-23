<link rel="stylesheet" href="{{ asset('static/css/bootstrap-editable.min.css') }}" />
<link rel="stylesheet" href="{{ asset('static/css/ace.min.css') }}" />
<link rel="stylesheet" href="{{ asset('static/css/dataTables.bootstrap.min.css') }}" />

<!-- page specific plugin scripts -->
<link rel="stylesheet" href="{{ asset('static/css/select2.min.css') }}" />

<script src="{{ asset('static/js/select2.min.js') }}"></script>
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
<script src="{{ asset('static/js/jquery.form.min.js') }}"></script>
<!-- inline scripts related to this page -->
<script type="text/javascript">
    //editables on first profile page
    $.fn.editable.defaults.mode = 'inline';
    $(document).ready(function(){
        var dt = $('#dynamic-table').DataTable({
            language: {
                url: '{{ asset('static/localisation/Chinese.json') }}'
            },
            processing: true,
            serverSide: true,
            bStateSave: true,
            ajax: '{{ route('resume.search', $type) }}',
            columns: [
                {
                    data: 'sn',
                    render: function (data, type, row )
                    {
                        return "<a href='{{ asset('/resume')}}/" + row.id+ "'>" + data +"</a>";
                    }
                },
                {data: 'name'},
                {data: null, defaultContent: '摘要'},
                {data: 'mobile'},
                {data: 'email'},
                {
                    data: 'feedback',
                    defaultContent: '新增反馈',
                    render: function (data, type, row)
                    {
                        if(!data)
                        {
                            data = '新增反馈';
                        }
                        return "<span class='editable editable-click' id='feedback[" + row.id + "]' data-name='text' data-emptytext='新增反馈' data-type='text' data-url='/resume/feedback' data-pk='"+row.id+"'>"+data +"</span>";
                    }
                },
                {
                    data: null,
                    render: function(data, type, row){
                        var spanGHtml = '';
                        $.each(row.lsx, function(index, value, array) {
                                spanGHtml += '<span>' + value + '</span>';
                            if((row.lsx.length - 1) != index){
                                spanGHtml += '<br/>';
                            }
                        });
                        return spanGHtml;
                    }
                },
                {
                    data: null,
                    render: function(data, type, row){
                        var btnGHtml = "<div class='dropdown'>" +
                            "<a data-toggle='dropdown' class='dropdown-toggle' href='#' aria-expanded='false'>" +
                                "<i class='purple ace-icon fa fa-asterisk bigger-120'></i>" +
                                "操作<i class='ace-icon fa fa-caret-down'></i></a>" +
                            "<ul class='dropdown-menu dropdown-lighter dropdown-125 pull-right'>" +
                                "<li>" +
                                    "<a href='{{ asset('/resume') }}/" + row.id + "'>"+
                                        "<i class='blue ace-icon fa fa-eye bigger-120'></i>查看 </a>" +
                                "</li>" +
                                "<li>" +
                                    "<a href='{{ asset('/resume/') }}/" + row.id + "#resume-tab-4') }}'>" +
                                        "<i class='blue ace-icon fa fa-bell-o bigger-120'></i>" +
                                        "提醒 </a>" +
                                "</li>";

                                @if ('my' != $type)
                                if(row.isMine == '0')
                                btnGHtml += "<li>" +
                                    "<a href='#' id='my-" + row.id + "'>" +
                                    "<i class='blue ace-icon fa fa-download bigger-120'></i>" +
                                        "加入我的简历库 </a>"+
                                "</li>";
                                @endif
                                @if ('job' != $type)
                                btnGHtml += "<li>" +
                                    "<a href='/resume/jobmodal/" + row.id + "' data-toggle='modal' data-target='#modal-job' data-rid='" + row.id + "'>" +
                                        "<i class='blue ace-icon fa fa-plus-square bigger-120'></i>" +
                                        "加入职位流水线 </a>" +
                                "</li>";
                                @endif
                            btnGHtml += "</ul></div>";
                            return btnGHtml;
                }}
        ]
        });

        $('#dynamic-table tbody').on('click','span[id^=feedback]', function (e) {
            $(this).editable({
                params: {'_token' : '{{ csrf_token() }}'},
                validate: function(value) {
                    if($.trim(value) == '') {
                        return '反馈不能为空！';
                    }
                }
            });
        });

        $('table.table tbody').on('click','a[id^=my-]', function (e) {
            var rid = $(this)[0].id.substring(3);
            $.ajax({
                type: 'post',
                url: '{{ url('/resume/my/add')}}/' + rid,
                data: { '_token' : '{{ csrf_token() }}' },
                success: function(response){
                    var data = $.parseJSON(response);
                    var type = data['code'] == 0 ? 'success' : 'error';
                    swal({
                        title: '加入我的简历库',
                        text: data['msg'],
                        type: type,
                        allowOutsideClick: false,
                    });
                    dt.draw(false);
                },
            });
        });

        $('#modal-job').on('hide.bs.modal', function () {
            $(this).removeData("bs.modal");
            $(".modal-content").children().remove();
        });

        $('#modal-job').on('loaded.bs.modal', function () {
            $('#jid').select2({
                placeholder: "请选择职位流水线",
                allowClear: true,
                width: 300
            });
        });

        $('#modal-job').ajaxForm({
            beforeSubmit:function(){
                var jid = $("#modal-job select[name=jid]").val();
                if(jid == ''){
                    swal({
                        title: '加入职位流水线',
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
                    title: '加入职位流水线',
                    text: data['msg'],
                    type: type,
                    allowOutsideClick: false,
                });
                if(type == 'success')
                {
                    $("#modal-job").modal("hide");
                }
                dt.draw(false);
            }
        });
    });
</script>
<div class="row">
<div class="col-xs-12">
<!-- PAGE CONTENT BEGINS -->
<div class="row">
    <div class="col-xs-12">
        <div class="table-header">
            简历列表
        </div>

        <!-- 简历列表--开始 -->
        <div>
            <table id='dynamic-table' class="table table-striped table-bordered table-hover" style="width: 100%">
                <thead>
                    <tr>
                        <th>编号</th>
                        <th>姓名</th>
                        <th>摘要</th>
                        <th>
                            <i class="ace-icon fa fa-mobile bigger-110 hidden-480"></i>
                            手机
                        </th>
                        <th>
                            <i class="ace-icon fa fa-envelope bigger-110 hidden-480"></i>
                            邮箱
                        </th>
                        <th>反馈</th>
                        <th>流水线</th>
                        <th>操作</th>
                    </tr>
                </thead>
            </table>
        </div>
        <!-- 简历列表--结束 -->
{{-- 加入简历库 --}}
<div class="modal fade" id="modal-job" tabIndex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        </div>
    </div>
</div>

<!-- PAGE CONTENT ENDS -->
</div><!-- /.col -->
</div>



