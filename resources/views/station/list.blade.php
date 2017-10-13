<!-- 简历列表--开始 -->
@if(count($stations))
<div class="col-md-12">
<table id='' class="table table-striped table-bordered table-hover" style="width: 100%">
    <thead>
        <tr>
            <th class="center">
                <label class="pos-rel">
                    <input type="checkbox" class="ace" />
                    <span class="lbl"></span>
                </label>
            </th>
            <th>编号</th>
            <th>姓名</th>
            <th>摘要</th>
            <th>
                <i class="ace-icon fa fa-mobile bigger-110 hidden-480"></i>
                手机
            </th>
            <th>
                <i class="ace-icon fa fa-envelope bigger-110 hidden-480"></i>
                邮箱
            </th>
            <th>反馈</th>
            <th>职位</th>
            <th>操作</th>
        </tr>
    </thead>
    <tbody>
        @foreach($stations as $station)
        <tr>
            <td class="center">
                <label class="pos-rel">
                    <input type="checkbox" class="ace" />
                    <span class="lbl"></span>
                </label>
            </td>
            <td><a href="{{ asset('/resume/'.$station->resume->id) }}">{{ $station->resume->sn }}</a></td>
            <td>{{ $station->resume->name }}</td>
            <td>摘要</td>
            <td>{{ $station->resume->mobile }}</td>
            <td>{{ $station->resume->email }}</td>
            <td><span class="editable editable-click" id="feedback[{{ $station->resume->id }}]" data-name="text" data-emptytext='新增反馈' data-type='text' data-url='/resume/feedback' data-pk="{{ $station->resume->id }}">{{ $station->resume->feedback }}
                </span>
            </td>
            <td>职位简历库</td>
            <td>
                <div class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#" aria-expanded="false">
                        <i class="purple ace-icon fa fa-asterisk bigger-120"></i>
                        操作
                        <i class="ace-icon fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-lighter dropdown-125 pull-right">
                        <li>
                            <a href="{{ asset('/resume/'.$station->resume->id) }}">
                            <i class="blue ace-icon fa fa-eye bigger-120"></i>
                             查看 </a>
                        </li>
                        <li>
                            <a href="{{ asset('/resume/'.$station->resume->id.'#resume-tab-4') }}">
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
</div>
@endif
<!-- 简历列表--结束 -->