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
<!-- inline scripts related to this page -->
<script type="text/javascript">
        //editables on first profile page
    $.fn.editable.defaults.mode = 'inline';
    $(document).ready(function(){
        $('#dynamic-table').DataTable({
            language: {
                url: '{{ asset('static/localisation/Chinese.json') }}'
            },
            processing: true,
            serverSide: true,
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
                    defaultContent: '职位简历库'
                },
                {
                    data: null,
                    render: function(data, type, row){
                        return    "<div class='dropdown'>" + 
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
                                          "</li>" + 
                                          "<li>" +
                                              "<a href='#' id='my-" + row.id + "'>" + 
                                              "<i class='blue ace-icon fa fa-download bigger-120'></i>" + 
                                               "加入我的简历库 </a>"+ 
                                          "</li>" + 
                                          "<li>" +
                                              "<a href='#' data-toggle='modal' data-target='#modal-job' data-rid='" + row.id + "'>" + 
                                              "<i class='blue ace-icon fa fa-plus-square bigger-120'></i>" + 
                                               "加入职位简历库 </a>" +
                                          "</li>" + 
                                      "</ul>" +
                                  "</div>";
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
                },
            });
        });
        $("#modal-job").on("show.bs.modal", function(e) {
            var btn = $(e.relatedTarget),
            rid = btn.data("rid");
            $("#modal-job input[name=rid]").val(rid);
        })

        $('#jid').select2({
            placeholder: "请选择职位简历库",
            allowClear: true,
            width: 300
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
                        <th>职位</th>
                        <th>操作</th>
                    </tr>
                </thead>
            </table>
        </div>
        <!-- 简历列表--结束 -->
    </div>
</div>

{{-- 加入简历库 --}}
<div class="modal fade" id="modal-job" tabIndex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                ×
                </button>
                <h4 class="modal-title">加入职位简历库</h4>
            </div>
            <div class="modal-body">
                <form  method="POST" action="">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="rid" value="">
                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-2 no-padding-right" for="jid">职位简历库:</label>
                        <div class="col-xs-6 col-sm-6">
                            <div class="clearfix">
                                <select name="jid" id="jid">
                                <option></option>
                                @isset ($lines)
                                @foreach ($lines as $line)
                                <option value="{{ $line->job->id }}">{{ $line->job->sn }}({{ $line->job->name }})</option>
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



