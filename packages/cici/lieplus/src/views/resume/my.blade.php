@extends('Lieplus::layouts.cici')

@section('title', '我的简历库')

@section('content')
<!-- PAGE CONTENT BEGINS -->
<div class="row">
  <div class="well well-sm">
    <form action="" class="form-inline">
      <input type="text" id="name" name="name" value="{{ !empty($filter['name']) ? $filter['name'] : '' }}" placeholder="姓名" class="form-control">
      <input type="text" id="mobile" name="mobile" value="{{ !empty($filter['mobile']) ? $filter['mobile'] : '' }}" placeholder="手机号" class="form-control">
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
  <table class="table table-striped table-bordered table-hover"> </table>
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
  // datatable配置
  var table = $('table').dataTable({
    processing: true,
    serverSide: true,
    ajax: '{{ route('resume.search') }}?t=my',
    language: {
      url: '{{ asset('static/localisation/Chinese.json') }}'
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
            return "<a href='{{ url('/resume')}}/" + row.id+ "'>" + data +"</a>";
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
        data: 'feedback'
      }, 
      {
        title: '流水线',
        data: null
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
  })

  $(document).on('submit', '.form-inline', function (e) {
    var target = $(e.target);
    table.api().ajax.url('{{ route('resume.search') }}?t=my' + '&' + target.serialize()).load();
    e.preventDefault();
  });
</script>

@endsection