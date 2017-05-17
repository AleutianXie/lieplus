<template>
<div class="container_fluid">
    <div class="table-header">
        简历列表
    </div>
    <div class="space-2"></div>
    <!-- 简历列表--开始 -->
    <table id='dynamic-table' class="table table-striped table-bordered table-hover" cellpadding="0" width="100%">
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
            <tr v-for="item in items">
                <td class="center">
                    <label class="pos-rel">
                        <input type="checkbox" class="ace" />
                        <span class="lbl"></span>
                    </label>
                </td>
                <td>{{ item.sn }}</td>
                <td>{{ item.name }}</td>
                <td>摘要</td>
                <td>{{ item.mobile }}</td>
                <td>{{ item.email }}</td>
                <td><span class="editable editable-click" id="" data-name="text" data-emptytext='新增反馈' data-type='text' data-url='/resume/feedback' data-pk="">{{ item.feedback }}</span></td>
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
                                <a href="">
                                <i class="blue ace-icon fa fa-eye bigger-120"></i>
                                 查看 </a>
                            </li>
                            <li>
                                <a href="">
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
        </tbody>
    </table>
    <!-- 简历列表--结束 -->
</div>
</template>

<style scoped>
@import "~bootstrap-editable/css/bootstrap-editable.css";
@import "/static/css/ace.min.css";
</style>
<script>

require('datatables.net')
require('datatables-bootstrap')
require('datatables-buttons')
require('datatables-select')
require('bootstrap-editable')

export default {
  data() {
    return {
    }
  },
  props: ['resumes'],
  computed: {
    items() {
        return JSON.parse(this.resumes)
    }
  },
  mounted() {
    $('#dynamic-table').DataTable({
        language: {
             url: '/static/localisation/Chinese.json'
        },
        select: true,
        dom: '<"col-xs-6"l><"col-xs-6"f>t<"space-8"><"col-xs-6"i><"col-xs-6"p>',
        pagingType: 'full_numbers',
        buttons: ['copy', 'excel', 'pdf'],
        renderer: {
            header: 'bootstrap',
            pageButton: 'bootstrap',
        }
    });
  }
}

</script>