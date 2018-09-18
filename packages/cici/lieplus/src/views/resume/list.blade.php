@section('content')
    <!-- PAGE CONTENT BEGINS -->
    <div class="row">
        <div class="well well-sm" style="margin-bottom: 10px;">
            <form action="" class="form-inline">
                <input type="text" id="name" name="name" value="{{ !empty($filter['name']) ? $filter['name'] : '' }}"
                       placeholder="姓名" class="form-control">
                <input type="text" id="mobile" name="mobile"
                       value="{{ !empty($filter['mobile']) ? $filter['mobile'] : '' }}" placeholder="手机号"
                       class="form-control">
                <input type="text" id="email" name="email" placeholder="邮箱" class="form-control">
                <button type="submit" class="btn btn-white btn-info btn-bold">
                    <i class="ace-icon fa fa-search nav-search-icon green"></i>搜索
                </button>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="table-header">
            简历列表
        </div>

        <!-- 简历列表--开始 -->
        <table class="table table-striped table-bordered table-hover"></table>
        <!-- 简历列表--结束 -->
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
        // datatables配置
        let dt = $('table').dataTable({
            processing: true,
            serverSide: true,
            @if(!isset($t))
            ajax: '{{ route('resume.search') }}',
            @elseif ($t == 'my')
            ajax: '{{ route('resume.search') }}?t=my',
            @elseif ($t == 'job')
            ajax: '{{ route('resume.search') }}?t=job&id={{ $id }}',
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
                    render: function (data, type, row) {
                        return "<a href='{{ url('/resume')}}/" + row.id + "'>" + data + "</a>";
                    }
                },
                {
                    title: '姓名',
                    data: 'name',
                },
                {
                    title: '摘要',
                    data: null,
                    defaultContent: '摘要',
                },
                {
                    title: '手机号',
                    data: 'mobile'
                },
                {
                    title: '邮箱',
                    data: 'email'
                },
                {
                    title: '反馈',
                    data: 'feedback',
                    render: function (data, type, row) {
                        return '<a href="#" data-type="text" data-pk="' + row.id + '" data-placement="right" data-placeholder="新增反馈" data-title="新增反馈" data-url="/feedback">' + data + '</a>';
                    }
                },
                {
                    title: '流水线',
                    data: 'line_links'
                },
                {
                    title: '操作',
                    data: 'options_link'
                }
            ],
            createdRow: function (row, data, index) {
                // console.log(row, $('td', row).eq(7).html());
                $('td', row).eq(5).children('a').editable({
                    emptytext: '新增反馈',
                    params: {'_token' : '{{ csrf_token() }}'},
                    validate: function(value) {
                        if($.trim(value) == '') {
                            return '反馈不能为空！';
                        }
                    }
                });
                $('td', row).eq(6).html($('td', row).eq(6).text());
                $('td', row).eq(7).html($('td', row).eq(7).text());
            }
        })

        $(document).on('submit', '.form-inline', function (e) {
            var target = $(e.target);
            dt.api().ajax.url('{{ route('resume.search') }}' + '?' + target.serialize()).load();
            e.preventDefault();
        });
        /// common js
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
                    dt.api().draw(false);
                },
            });
        });

        addToLine = async function () {
            const {value: country} = await swal({
                title: '加入职位流水线',
                input: 'select',
                inputOptions: {
                    'SRB': 'Serbia',
                    'UKR': 'Ukraine',
                    'HRV': 'Croatia'
                },
                inputPlaceholder: 'Select country',
                showCancelButton: true,
                inputValidator: (value) => {
                    return new Promise((resolve) => {
                        if (value === 'UKR') {
                            resolve()
                        } else {
                            resolve('You need to select Ukraine :)')
                        }
                    })
                }
            })

            if (country) {
                swal('You selected: ' + country)
            }
        }
    </script>
@endsection
