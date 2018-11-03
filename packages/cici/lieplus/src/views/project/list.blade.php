@section('content')
    <!-- PAGE CONTENT BEGINS -->
    <div class="row">
        <div class="well well-sm" style="margin-bottom: 10px;">
            <form action="" class="form-inline">
                <input type="text" id="company_name" name="company_name" value="{{ !empty($filter['company_name']) ? $filter['company_name'] : '' }}" placeholder="公司名称" class="form-control">
                <input type="text" id="job_name" name="job_name"
                       value="{{ !empty($filter['job_name']) ? $filter['job_name'] : '' }}" placeholder="职位名称" class="form-control">
                <button type="submit" class="btn btn-white btn-info btn-bold">
                    <i class="ace-icon fa fa-search nav-search-icon green"></i>搜索
                </button>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="table-header">
            项目启动书列表
        </div>

        <!-- 项目启动书列表--开始 -->
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover" style="width:100%"></table>
        </div>
        <!-- 项目启动书列表--结束 -->
        <!-- PAGE CONTENT ENDS -->
    </div>

    {{-- 加入简历库 --}}
    <div class="modal fade" id="modal-job" tabIndex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        let levels = [];
        levels[0] = '未设置';
        $.each({!! json_encode(config('lieplus.company.level')) !!}, function(k, v) {
            levels[k] = v;
        });
        let types = [];
        types[0] = '未设置';
        $.each({!! json_encode(config('lieplus.company.type')) !!}, function(k, v) {
            types[k] = v;
        });
        let statusis = [];
        $.each({!! json_encode(config('lieplus.project.status')) !!}, function(k, v) {
            statusis[k] = v;
        });
        // datatables配置
        let dt = $('table').dataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('project.search') }}',
            language: {
                url: '{{ asset('js/localisation/Chinese.json') }}'
            },
            searching: false,
            ordering: false,
            dom: "<'row'<'col-sm-6'l><'col-sm-6'f>><'row'tr><'row'<'col-sm-5'i><'col-sm-7'p>>",
            columns: [
                {
                    title: '编号',
                    data: 'serial_number',
                    render: function (data, type, row) {
                        return "<a href='{{ url('/project')}}/" + row.id + "'>" + data + "</a>";
                    }
                },
                {
                    title: '公司全称',
                    data: 'company_name',
                },
                {
                    title: '职位名称',
                    data: 'job_name'
                },
                {
                    title: '级别',
                    data: 'company_level',
                    render: function (data, type, row) {
                        return levels[data];
                    }
                },
                {
                    title: '类型',
                    data: 'company_type',
                    render: function (data, type, row) {
                        return types[data];
                    }
                },
                {
                    title: '状态',
                    data: 'status',
                    render: function (data, type, row) {
                        return statusis[data];
                    }
                },
                {
                    title: '操作',
                    data: 'options_link'
                }
            ],
            createdRow: function (row, data, index) {
                if (data.status == 0) {
                    $('td', row).eq(5).addClass("info");
                }
                if (data.status == 1) {
                    $('td', row).eq(5).addClass("success");
                }
                if (data.status == 2) {
                    $('td', row).eq(5).addClass("danger");
                }

                $('td', row).eq(6).html($('td', row).eq(6).text());
            }
        })

        $(document).on('submit', '.form-inline', function (e) {
            var target = $(e.target);
            dt.api().ajax.url('{{ route('project.search') }}' + '?' + target.serialize()).load();
            e.preventDefault();
        });
    </script>
@endsection
