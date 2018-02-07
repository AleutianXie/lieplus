<link rel="stylesheet" href="{{ asset('static/css/bootstrap-editable.min.css') }}" />
<link rel="stylesheet" href="{{ asset('static/css/jquery-ui.min.css') }}" />

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
<script src="{{ asset('static/js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('static/js/jquery.ui.touch-punch.min.js') }}"></script>
<div class="table-header">
    <div class="col-xs-10">
    提醒列表
    </div>
    <button class="btn btn-primary" onclick="add({{ $resume->id }});">
        <i class="ace-icon fa fa-plus-circle align-top bigger-125"></i>
            新建提醒
    </button>
</div>

<!-- 提醒列表--开始 -->
<div>
    @if(count($alerts))
    <table id='dynamic-table' class="table table-striped table-bordered table-hover" style="width: 100%">
        <thead>
            <tr>
                <th>类别</th>
                <th>对象</th>
                <th>
                    <i class="ace-icon fa fa-comment-o bigger-110 hidden-480"></i>
                    批注
                </th>
                <th>
                    <i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
                    时刻
                </th>
                <th>
                    <i class="ace-icon fa fa-child bigger-110 hidden-480"></i>
                    执行者
                </th>
                <th>创建者</th>
                <th>
                    <i class="ace-icon fa fa-cogs bigger-110 hidden-480"></i>
                    操作
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($alerts as $alert)
            <tr>
                <td>{{ $alert->type }}</td>
                <td>{{ $resume->name }}</td>
                <td>{{ $alert->description }}</td>
                <td>{{ $alert->alert_at }}</td>
                <td>{{ Auth::user($alert->operator)->name }}</td>
                <td>{{ Auth::user($alert->creater)->name }}</td>
                <td>
                    <div class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#" aria-expanded="false">
                            <i class="purple ace-icon fa fa-asterisk bigger-120"></i>
                            操作
                            <i class="ace-icon fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-lighter dropdown-125 pull-right">
                            <li>
                                <a href="javascript:void(-1);" onclick="edit({{ $resume->id }}, {{ $alert->id }});">
                                <i class="blue ace-icon fa fa-edit bigger-120"></i>
                                 编辑 </a>
                            </li>
                            <li>
                                <a href="{{ asset('/resume/'.$resume->id.'#resume-tab-4') }}">
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
    <div id="detail-dialog" class="row hide">

    </div>
    <!-- inline scripts related to this page -->
    <script type="text/javascript">
        $(document).ready(function(){
            $('#dynamic-table').dataTable({
                language: {
                    url: '{{ asset('static/localisation/Chinese.json') }}'
                }
            });
        });

        function edit(rid, id){
            $("#detail-dialog").removeClass('hide').load('/alert/'+rid+'/'+id).dialog({
                modal: true,
                title: "编辑提醒",
                width: '700px',
                resizable: false,
            });
        }

        function add(rid){
            $("#detail-dialog").removeClass('hide').load('/alert/add/'+rid).dialog({
                modal: true,
                title: "新建提醒",
                width: '700px',
                resizable: false
            });
        }
    </script>
</div>
<!-- 提醒列表--结束 -->



