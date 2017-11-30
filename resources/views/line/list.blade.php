<link rel="stylesheet" href="{{ asset('static/css/select2.min.css') }}" />
<link rel="stylesheet" href="{{ asset('static/css/bootstrap-editable.min.css') }}" />
<link rel="stylesheet" href="{{ asset('static/css/ace.min.css') }}" />
<link rel="stylesheet" href="{{ asset('static/css/dataTables.bootstrap.min.css') }}" />

<script src="{{ asset('static/js/select2.min.js') }}"></script>
<!-- page specific plugin scripts -->
<script src="{{ asset('static/js/ace-elements.min.js') }}"></script>
<!-- ace settings handler -->
<script src="{{ asset('static/js/ace-extra.min.js') }}"></script>

<script src="{{ asset('static/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('static/js/jquery.dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('static/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('static/js/buttons.flash.min.js') }}"></script>
<script src="{{ asset('static/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('static/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('static/js/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('static/js/dataTables.select.min.js') }}"></script>
<script src="{{ asset('static/js/bootstrap-editable.min.js') }}"></script>
<!-- inline scripts related to this page -->
<script type="text/javascript">
    $(document).ready(function(){
        $('#dynamic-table').DataTable({
            language: {
                url: '{{ asset('static/localisation/Chinese.json') }}'
            },
            processing: true,
            serverSide: true,
            ajax: '{{ route('line.search', $type) }}',
            ordering: false,
            columns: [
                {
                    data: 'sn',
                    render: function (data, type, row )
                    {
                        return "<a href='{{ asset('/line')}}/" + row.id+ "'>" + data +"</a>";
                    }
                },
                {data: 'recruiter'},
                {data: 'exclusive', defaultContent: '否',},
                {data: 'priority'},
                {data: 'job.name'},
                {data: 'job.customer.name'},
                {data: 'job.department.name'},
                {
                    data: null,
                    render: function (data, type, row)
                    {
                        return '联系中(' + row.connection.length +') 意向中(' + row.intention.length + ') 推荐中(' + row.recommendation.length + ')) 面试中(' + row.interview.length + ') offer中(' + row.offer.length + ') 入职中(' + row.onboard.length + ')';
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
                                  "<a href='{{ asset('/line') }}/" + row.id + "'>"+
                                  "<i class='blue ace-icon fa fa-eye bigger-120'></i>查看 </a>" +
                              "</li>";
                        @role('admin|manager|customer')
                        btnGHtml += "<li>" +
                        "<a href='javascript:void(-1);' onclick='assign(" + row.id + ");'>" +
                        "<i class='blue ace-icon fa fa-hand-pointer-o bigger-120'></i>" +
                        "分配招聘顾问 </a>" +
                        "</li>";
                        @endrole
                        btnGHtml += "</ul></div>";
                        return btnGHtml;
                }}
        ]
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
            职位流水线列表
        </div>

        <!-- 简历列表--开始 -->
        <div>
            <table id='dynamic-table' class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>编号</th>
                        <th>客户顾问</th>
                        <th>是否专属</th>
                        <th>
                            等级
                        </th>
                        <th>
                            职位名称
                        </th>
                        <th>客户名称</th>
                        <th>部门</th>
                        <th>动态</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
            <div id="optional-dialog" class="row hide">
        </div>
        <!-- 简历列表--结束 -->
    </div>
</div>

<!-- PAGE CONTENT ENDS -->
</div><!-- /.col -->
</div>

@section('scripts')
    <!-- inline scripts related to this page -->
    <link rel="stylesheet" href="{{ asset('static/css/jquery-ui.min.css') }}" />
    <script src="{{ asset('static/js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('static/js/jquery.ui.touch-punch.min.js') }}"></script>
    <script type="text/javascript">
        function assign(id){
            $("#optional-dialog").removeClass('hide').load('/line/assign/'+id).dialog({
                modal: true,
                title: "分配招聘顾问",
                width: '25%',
                resizable: false
            });
        }
    </script>
@endsection
