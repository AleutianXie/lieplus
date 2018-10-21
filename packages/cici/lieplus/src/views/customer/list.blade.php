@section('content')
    <!-- PAGE CONTENT BEGINS -->
    <div class="row">
        <div class="well well-sm" style="margin-bottom: 10px;">
            <form action="" class="form-inline">
                <input type="text" id="name" name="name" value="{{ !empty($filter['name']) ? $filter['name'] : '' }}" placeholder="公司名称" class="form-control">
                <input type="text" id="industry" name="industry" class="form-control">
                <input type="text" id="property" name="property" class="form-control">
                <button type="submit" class="btn btn-white btn-info btn-bold">
                    <i class="ace-icon fa fa-search nav-search-icon green"></i>搜索
                </button>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="table-header">
            客户列表
        </div>

        <!-- 客户列表--开始 -->
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover" style="width:100%"></table>
        </div>
        <!-- 客户列表--结束 -->
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
        var industries = [];
        var industry_dt = [];
        $.each({!! json_encode(config('lieplus.industry')) !!}, function(k, v) {
            industry_dt[k] = v;
            industries.push({id: k, text: v});
        });
        var properties = [];
        var property_dt = [];
        $.each({!! json_encode(config('lieplus.company.property')) !!}, function(k, v) {
            property_dt[k] = v;
            properties.push({id: k, text: v});
        });
        var levels = [];
        var level_dt = [];
        $.each({!! json_encode(config('lieplus.company.level')) !!}, function(k, v) {
            level_dt[k] = v;
            levels.push({id: k, text: v});
        });
        $('#industry').select2({
            data: industries,
            placeholder: '行业',
            allowClear: true
        });
        @if (!empty($filter['industry']))
        $('#industry').val({{ $filter['industry'] }}).trigger('change');
        @endif
        $('#property').select2({
            data: properties,
            placeholder: '公司类型',
            allowClear: true,
            width: 250
        });
        @if (!empty($filter['property']))
        $('#property').val({{ $filter['property'] }}).trigger('change');
        @endif
        // datatable配置
        let dt = $('table').dataTable({
            processing: true,
            serverSide: true,
            @if(isset($t))
            ajax: '{{ route('customer.search') }}?t=my&' + $('.form-inline').serialize(),
            @else
            ajax: '{{ route('customer.search') }}?' + $('.form-inline').serialize(),
            @endif
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
                    render: function (data, type, row)
                    {
                        return "<a href='{{ url('/customer')}}/" + row.id+ "'>" + data +"</a>";
                    }
                },
                {
                    title: '公司名称',
                    data: 'name',
                },
                {
                    title: '行业',
                    data: 'industry',
                    render: function (data, type, row)
                    {
                        return industry_dt[data];
                    }
                },
                {
                    title: '职位数',
                    data: null,
                },
                {
                    title: '公司类型',
                    data: 'property',
                    render: function (data, type, row)
                    {
                        return property_dt[data];
                    }
                },
                {
                    title: '等级',
                    data: 'level',
                    render: function (data, type, row) {
                        return level_dt[data];
                    }
                },
                {
                    title: '客户顾问',
                    data: null,
                },
                {
                    title: '操作',
                    data: null
                    // render : function (data, type, row) {
                    //   // // 根据状态判断是否显示退款按钮
                    //   // var orderS = row.order_state
                    //   // var refundS = row.refund_state
                    //   // var royaltyT = row.royalty_extend != null ? row.royalty_extend.royalty_type : ''
                    //   // var royaltyS = row.royalty_state
                    //   // var payMode = row.pay_mode
                    //   // var button = `<button data-id="${row.id}"class="btn-danger btn btn-sm btn-refund">退款</button>`
                    // },
                }
            ]
        });

        $(document).on('submit', '.form-inline', function (e) {
            var target = $(e.target);
            dt.api().ajax.url('{{ route('customer.search') }}?t=my' + '&' + target.serialize()).load();
            e.preventDefault();
        });
    </script>
@endsection
