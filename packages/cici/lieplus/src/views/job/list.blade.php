@section('content')
    <!-- PAGE CONTENT BEGINS -->
    <div class="row">
        <div class="well well-sm" style="margin-bottom: 10px;">
            <form action="" class="form-inline">
                <input type="text" id="name" name="name" value="{{ !empty($filter['name']) ? $filter['name'] : '' }}" placeholder="职位名称" class="form-control">
                <input type="text" id="work_years" name="work_years" class="form-control">
                <input type="text" id="gender" name="gender" class="form-control">
                <input type="text" id="majors" name="majors" class="form-control">
                <input type="text" id="degree" name="degree" class="form-control">
                <input type="text" id="unified" name="unified" class="form-control">
                <button type="submit" class="btn btn-white btn-info btn-bold">
                    <i class="ace-icon fa fa-search nav-search-icon green"></i>搜索
                </button>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="table-header">
            职位列表
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
        var workYears = [];
        var workYears_dt = [];
        workYears_dt[0] = '不限';
        $.each({!! json_encode(config('lieplus.workyears')) !!}, function(k, v) {
            workYears_dt[k] = v;
            workYears.push({id: k, text: v});
        });
        var gender = [];
        var gender_dt = [];
        gender_dt[0] = '不限';
        $.each({!! json_encode(config('lieplus.gender')) !!}, function(k, v) {
            gender_dt[k] = v;
            gender.push({id: k, text: v});
        });
        var majors = [];
        var majors_dt = [];
        majors_dt[0] = '不限';
        $.each({!! json_encode(config('lieplus.majors')) !!}, function(k, v) {
            majors_dt[k] = v;
            majors.push({id: k, text: v});
        });
        var degree = [];
        var degree_dt = [];
        degree_dt[0] = '不限';
        $.each({!! json_encode(config('lieplus.degree')) !!}, function(k, v) {
            degree_dt[k] = v;
            degree.push({id: k, text: v});
        });
        $('#work_years').select2({
            data: workYears,
            placeholder: '工作年限',
            allowClear: true
        });
        @if (!empty($filter['work_years']))
        $('#work_years').val({{ $filter['work_years'] }}).trigger('change');
        @endif
        $('#gender').select2({
            data: gender,
            placeholder: '性别',
            allowClear: true
        });
        @if (!empty($filter['gender']))
        $('#gender').val({{ $filter['gender'] }}).trigger('change');
        @endif
        $('#majors').select2({
            data: majors,
            placeholder: '专业',
            allowClear: true
        });
        @if (!empty($filter['majors']))
        $('#majors').val({{ $filter['majors'] }}).trigger('change');
        @endif
        @if (!empty($filter['degree']))
        $('#degree').val({{ $filter['degree'] }}).trigger('change');
        @endif
        $('#degree').select2({
            data: degree,
            placeholder: '学历',
            allowClear: true
        });
        @if (!empty($filter['degree']))
        $('#degree').val({{ $filter['degree'] }}).trigger('change');
            @endif
        var unified = [];
        unified.push({id: 0, text: '否'});
        unified.push({id: 1, text: '是'});
        $('#unified').select2({
            data: unified,
            placeholder: '是否统招',
            allowClear: true
        });
        @if (!empty($filter['unified']))
        $('#unified').val({{ $filter['unified'] }}).trigger('change');
        @endif
        // datatable配置
        let dt = $('table').dataTable({
            processing: true,
            serverSide: true,
            @if(isset($t))
            ajax: '{{ route('job.search') }}?t=my&' + $('.form-inline').serialize(),
            @else
            ajax: '{{ route('job.search') }}?' + $('.form-inline').serialize(),
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
                        return "<a href='{{ url('/job')}}/" + row.id+ "'>" + data +"</a>";
                    }
                },
                {
                    title: '客户全称',
                    data: 'department.customer.name',
                },
                {
                    title: '客户顾问',
                    data: 'department.customer.adviser',
                },
                {
                    title: '职位名称',
                    data: 'name',
                },
                {
                    title: '工作年限',
                    data: 'work_years',
                    render: function (data, type, row)
                    {
                        return workYears_dt[data];
                    }
                },
                {
                    title: '性别',
                    data: 'gender',
                    render: function (data, type, row)
                    {
                        return gender_dt[data];
                    }
                },
                {
                    title: '专业',
                    data: 'majors',
                    render: function (data, type, row)
                    {
                        return majors_dt[data];
                    }
                },
                {
                    title: '学历',
                    data: 'degree',
                    render: function (data, type, row)
                    {
                        return degree_dt[data];
                    }
                },
                {
                    title: '统招?',
                    data: 'unified',
                    render: function (data, type, row)
                    {
                        return data == 1 ? '是' : '否';
                    }
                },
                {
                    title: '状态',
                    data: 'closed',
                    render: function (data, type, row)
                    {
                        return data == 1 ? '暂停' : '开放';
                    }
                },
                {
                    title: '操作',
                    data: 'options_link'
                }
            ],
            createdRow: function (row, data, index) {
                if (data.closed == 0) {
                    $('td', row).eq(9).addClass("success");
                }
                if (data.closed == 1) {
                    $('td', row).eq(9).addClass("danger");
                }

                $('td', row).eq(10).html($('td', row).eq(10).text());
            }
        });

        $(document).on('submit', '.form-inline', function (e) {
            var target = $(e.target);
            dt.api().ajax.url('{{ route('job.search') }}?t=my' + '&' + target.serialize()).load();
            e.preventDefault();
        });
    </script>
@endsection
