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
<!-- inline scripts related to this page -->
<script type="text/javascript">
    $(document).ready(function(){
        $('#dynamic-table').DataTable({
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
                {data: 'name'},
                {data: 'industry'},
                {
                    data: null,
                    defaultContent: '0',
                },
                {
                    data: null,
                    defaultContent: '0',
                },
                {
                    data: null,
                    defaultContent: '0',
                },
                {
                    data: 'level',
                    defaultContent: '不限',
                    render: function (data, type, row)
                    {
                        if(data == '')
                        {
                            data = '不限';
                        }
                        return data;
                    }
                },
                {
                    data: 'property',
                    defaultContent: '是',
                    render: function (data, type, row)
                    {
                        return data == 1 ? '是' : '否';
                    }
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
                                              "<a href='{{ asset('/customer') }}/" + row.id + "'>"+
                                              "<i class='blue ace-icon fa fa-eye bigger-120'></i>查看 </a>" + 
                                          "</li>" +  
                                          "<li>" +
                                              "<a href='#'>" + 
                                              "<i class='blue ace-icon fa fa-download bigger-120'></i>" + 
                                               "分配客户顾问 </a>"+ 
                                          "</li>" + 
                                          "<li>" +
                                              "<a href='#'>" + 
                                              "<i class='blue ace-icon fa fa-plus-square bigger-120'></i>" + 
                                               "暂停合作 </a>" +
                                          "</li>" + 
                                          "<li>" + 
                                              "<a href='#'>" +
                                              "<i class='blue ace-icon fa fa-plus-circle bigger-120'></i>" +
                                               "增加职位 </a>" +
                                          "</li>" + 
                                      "</ul>" +
                                  "</div>";
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

<!-- PAGE CONTENT ENDS -->
</div><!-- /.col -->
</div>



