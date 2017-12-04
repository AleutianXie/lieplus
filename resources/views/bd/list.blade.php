<link rel="stylesheet" href="{{ asset('static/css/select2.min.css') }}" />
<link rel="stylesheet" href="{{ asset('static/css/bootstrap-editable.min.css') }}" />
<link rel="stylesheet" href="{{ asset('static/css/ace.min.css') }}" />
<link rel="stylesheet" href="{{ asset('static/css/dataTables.bootstrap.min.css') }}" />

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
<script src="{{ asset('static/js/select2.min.js') }}"></script>
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
            ajax: '{{ route('project.search', 'all') }}',
            ordering: false,
            columns: [
                {
                    data: 'sn',
                    render: function (data, type, row )
                    {
                        return "<a href='{{ asset('/project')}}/" + row.id+ "'>" + data +"</a>";
                    }
                },
                {data: 'company.name'},
                {data: 'job.name'},
                {
                    data: 'company.level',
                    render: function (data, type, row)
                    {
                        return "<span class='editable editable-click' id='level-" + row.company.id + "' data-name='level' data-type='select2' data-url='/customer/edit' data-pk='" + row.company.id + "'>" + data + "</span>";
                    }
                },
                {
                    data: 'company.type',
                    render: function (data, type, row)
                    {
                        return "<span class='editable editable-click' id='type-" + row.company.id + "' data-name='type' data-type='select2' data-url='/customer/edit' data-pk='" + row.company.id + "'>" + data + "</span>";
                    }
                },
                {
                    data: 'status',
                    render: function (data, type, row)
                    {
                        return "<span class='editable editable-click' id='status-" + row.id + "' data-name='status' data-type='select2' data-url='/project/edit' data-pk='" + row.id + "'>" + data + "</span>";
                    }
                }
        ]
        });

        $('#dynamic-table tbody').on('click','span[id^=level-]', function (e) {
            $(this).editable({
                params: {'_token' : '{{ csrf_token() }}'},
                source: {!! json_encode(config('lieplus.companylevel')) !!},
                select2: {
                    minimumResultsForSearch: Infinity,
                    'width': 140,
                }
            });
        });

        $('#dynamic-table tbody').on('click','span[id^=type-]', function (e) {
            $(this).editable({
                params: {'_token' : '{{ csrf_token() }}'},
                source: {!! json_encode(config('lieplus.companytype')) !!},
                select2: {
                    minimumResultsForSearch: Infinity,
                    'width': 140,
                }
            });
        });

        $('#dynamic-table tbody').on('click','span[id^=status-]', function (e) {
            $(this).editable({
                params: {'_token' : '{{ csrf_token() }}'},
                source: {!! json_encode(config('lieplus.projectstatus')) !!},
                select2: {
                    minimumResultsForSearch: Infinity,
                    'width': 140,
                }
            });
        });
    });
</script>

<div class="row">
<div class="col-xs-12">
<!-- PAGE CONTENT BEGINS -->
<div class="row">
    <div class="col-xs-12">
        <div class="table-header">
            项目启动书列表
        </div>

        <!-- 项目启动书列表--开始 -->
        <div>
            <table id='dynamic-table' class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>编号</th>
                        <th>公司全称</th>
                        <th>职位名称</th>
                        <th>级别</th>
                        <th>类型</th>
                        <th>状态</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
        <!-- 项目启动书列表--结束 -->
    </div>
</div>

<!-- PAGE CONTENT ENDS -->
</div><!-- /.col -->
</div>



