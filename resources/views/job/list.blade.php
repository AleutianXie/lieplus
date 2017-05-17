<link rel="stylesheet" href="{{ asset('static/css/bootstrap-editable.min.css') }}" />

<!-- page specific plugin scripts -->
<script src="{{ asset('static/js/jquery-2.1.4.min.js') }}"></script>
<script src="{{ asset('static/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('static/js/jquery.dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('static/js/bootstrap.min.js') }}"></script>
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
            职位列表
        </div>

        <!-- 客户列表--开始 -->
        <div>
            @if(count($jobs))
            <table id='dynamic-table' class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="center">
                            <label class="pos-rel">
                                <input type="checkbox" class="ace" />
                                <span class="lbl"></span>
                            </label>
                        </th>
                        <th>编号</th>
                        <th>客户全称</th>
                        <th>职位名称</th>
                        <th>工作年限</th>
                        <th>性别</th>
                        <th>专业</th>
                        <th>学历</th>
                        <th>是否统招</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($jobs as $job)
                    <tr>
                        <td class="center">
                            <label class="pos-rel">
                                <input type="checkbox" class="ace" />
                                <span class="lbl"></span>
                            </label>
                        </td>
                        <td>{{ $job->sn }}</td>
                        <td>{{ $job->customer->name }}</td>
                        <td>{{ $job->name }}</td>
                        <td>{{ $job->workyears != '' ? $job->workyears : '不限' }}</td>
                        <td>{{ $job->gender != '' ? $job->gender : '不限' }}</td>
                        <td>{{ $job->majors != '' ? $job->majors : '不限' }}</td>
                        <td>{{ $job->degree != '' ? $job->degree : '不限' }}</td>
                        <td>{{ $job->unified == 1 ? '是' : '否' }}</td>
                        <td>
                            <div class="dropdown">
                                <a data-toggle="dropdown" class="dropdown-toggle" href="#" aria-expanded="false">
                                    <i class="purple ace-icon fa fa-asterisk bigger-120"></i>
                                    操作
                                    <i class="ace-icon fa fa-caret-down"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-lighter dropdown-125 pull-right">
                                    <li>
                                        <a href="{{ asset('/resume/'.$job->id) }}">
                                        <i class="blue ace-icon fa fa-eye bigger-120"></i>
                                         查看 </a>
                                    </li>
                                    <li>
                                        <a href="{{ asset('/resume/'.$job->id.'#resume-tab-4') }}">
                                        <i class="blue ace-icon fa fa-bell-o bigger-120"></i>
                                         提醒 </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                        <i class="blue ace-icon fa fa-plus-square bigger-120"></i>
                                         加入职位简历库 </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                        <i class="blue ace-icon fa fa-plus-circle bigger-120"></i>
                                         重新加入工作台 </a>
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



