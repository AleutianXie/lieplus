<link rel="stylesheet" href="{{ asset('static/css/bootstrap-editable.min.css') }}" />
<link rel="stylesheet" href="{{ asset('static/css/ace.min.css') }}" />

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
        $('#dynamic-table').dataTable({
            language: {
                url: '{{ asset('static/localisation/Chinese.json') }}'
            }
        });

        $('span[id^=feedback').each(function(){
            $(this).editable({
                params: {'_token' : '{{ csrf_token() }}'},
                validate: function(value) {
                    if($.trim(value) == '') {
                        return '反馈不能为空！';
                    }
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
{{--         <h3 class="header smaller lighter blue">jQuery dataTables</h3>

        <div class="clearfix">
            <div class="pull-right tableTools-container"></div>
        </div> --}}
        <div class="table-header">
            客户列表
        </div>

        <!-- 客户列表--开始 -->
        <div>
            @if(count($customers))
            <table id='dynamic-table' class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="center">
                            <label class="pos-rel">
                                <input type="checkbox" class="ace" />
                                <span class="lbl"></span>
                            </label>
                        </th>
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
                    @foreach($customers as $customer)
                    <tr>
                        <td class="center">
                            <label class="pos-rel">
                                <input type="checkbox" class="ace" />
                                <span class="lbl"></span>
                            </label>
                        </td>
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
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>
        <!-- 客户列表--结束 -->
    </div>
</div>

<!-- PAGE CONTENT ENDS -->
</div><!-- /.col -->
</div>



