<!-- 简历列表--开始 -->
<div class="col-md-12">
<table data-status={{ $status }} class="table table-striped table-bordered table-hover" style="width: 100%">
    <thead>
        <tr>
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
            <th>招聘顾问</th>
            @isset ($plan)
                <th>流水线</th>
            @endisset
            <th>操作</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
</div>
<!-- 简历列表--结束 -->