@extends('Lieplus::layouts.cici')

@section('title', '我的简历库')

@section('content')
<!-- PAGE CONTENT BEGINS -->
<div class="row">
        <div class="table-header">
            简历列表
        </div>

        <!-- 简历列表--开始 -->
            <table class="table table-striped table-bordered table-hover">
{{--                 <thead>
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
                        <th>流水线</th>
                        <th>操作</th>
                    </tr>
                </thead> --}}
            </table>
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
          data: null
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
  // 事件委托 绑定点击事件
  // $('.user-table').click(function (e) {
  //   var target = $(e.target)
  //   if (target.hasClass('btn-refund')) {
  //     $.get({
  //       url: '{/' + target.attr('data-id') + '/manualrefund',
  //       success: function (data) {
  //         $('#dorefund').find('.modal-content').html(data)
  //         $('#dorefund').modal('show')
  //         $.validator.setDefaults({
  //             submitHandler: function(e) {
  //               console.log(e)
  //               var result = getFormParams($('.form-refund'))
  //               // if (!result.productVCs) {
  //               //   alert('至少需要选择一项验证码！')
  //               //   return
  //               // }
  //               var str = getStrFromObject(result)
  //               $.post({
  //                 url: $('.form-refund').attr('action'),
  //                 data: str,
  //                 success: function (data) {
  //                   $('#dorefund').modal('hide')
  //                   createMessage(data.success, data.info)
  //                   if (data.success) {
  //                     target.text('退款中')
  //                     target.attr('disabled', 'true')
  //                   }
  //                 },
  //                 error: function (err) {
  //                   var obj = err.responseJSON;
  //                   var errMsg = new Array();
  //                   for (var i in obj) {
  //                     for(var x=0; x<obj[i].length; x++)
  //                     {
  //                       errMsg.push(obj[i][x]);
  //                     }
  //                   }
  //                   $('#dorefund').modal('hide')
  //                   createMessage(false, errMsg)
  //                 }
  //               })
  //             }
  //         });
  //         var refundMax = $('.form-refund input[name=amount]').attr('data-max')
  //         $('.form-refund').validate({
  //           rules: {
  //             amount: {
  //               required: true,
  //               max: refundMax,
  //               min: '0.001'
  //             },
  //             reason: {
  //               required: true
  //             }
  //           },
  //           messages: {
  //             amount: {
  //               required: '退款金额是必填项',
  //               max: '退款金额必须小于' + refundMax + '元',
  //               min: '退款金额不能等于或小于0元'
  //             },
  //             reason: {
  //               required: '退款原因是必填项'
  //             }
  //           }
  //         })
  //       },
  //       error: function () {
  //         $('#dorefund .modal-content').html('阿偶，出错了')
  //       }
  //     })
  //   }
  // })

  // datatable渲染完成之后
  // $('.user-table').on('draw.dt', function () {
  //   dialogs = {}
  //   $('.tag-consume').mouseenter(function () {
  //     timeout = setTimeout(() => {
  //       var wrapper = $(this).parent()
  //       var id = $(this).attr('data-id')
  //       wrapper.append(initDialog('consume'))
  //       if (dialogs[id] && dialogs[id].consume) {
  //         wrapper.find('.dialog').html(dialogs[id].consume)
  //       } else {
  //         if (request) {
  //           request.abort()
  //         }
  //         request = $.get({
  //           url: '/' + id + '/consume',
  //           success: function (data) {
  //             request = null
  //             singleDialog(id, 'consume', data)
  //             wrapper.find('.dialog').html(data)
  //           },
  //           error: function (err) {
  //             request = null
  //             wrapper.find('.dialog').html(err)
  //           }
  //         })
  //       }
  //       handleRemoveDialog(wrapper)
  //     }, 500);
  //   }).mouseleave(function () {
  //     clearTimeout(timeout)
  //   })
  //   $('.tag-royalty').mouseenter(function () {
  //     timeout = setTimeout(() => {
  //       var royalty = $(this).attr('data-royalty')
  //       if (royalty == 0) return

  //       var wrapper = $(this).parent()
  //       var id = $(this).attr('data-id')
  //       wrapper.append(initDialog('royalty'))
  //       if (dialogs[id] && dialogs[id].royalty) {
  //         wrapper.find('.dialog').html(dialogs[id].royalty)
  //       } else {
  //         if (request) {
  //           request.abort()
  //         }
  //         request = $.get({
  //           url: '/' + id + '/royalty',
  //           success: function (data) {
  //             request = null
  //             singleDialog(id, 'royalty', data)
  //             wrapper.find('.dialog').html(data)
  //           },
  //           error: function (err) {
  //             request = null
  //             wrapper.find('.dialog').html(err)
  //           }
  //         })
  //       }
  //       handleRemoveDialog(wrapper)
  //     }, 500);
  //   }).mouseleave(function () {
  //     clearTimeout(timeout)
  //   })
  //   $('.tag-refund').mouseenter(function () {
  //     timeout = setTimeout(() => {
  //       var refund = $(this).attr('data-refund')
  //       if (refund == 0) return

  //       var wrapper = $(this).parent()
  //       var id = $(this).attr('data-id')
  //       wrapper.append(initDialog('refund'))
  //       if (dialogs[id] && dialogs[id].refund) {
  //         wrapper.find('.dialog').html(dialogs[id].refund)
  //       } else {
  //         if (request) {
  //           request.abort()
  //         }
  //         request = $.get({
  //           url: '/' + id + '/refund',
  //           success: function (data) {
  //             request = null
  //             singleDialog(id, 'refund', data)
  //             wrapper.find('.dialog').html(data)
  //           },
  //           error: function (err) {
  //             request = null
  //             wrapper.find('.dialog').html(err)
  //           }
  //         })
  //       }
  //       handleRemoveDialog(wrapper)
  //     }, 500);
  //   }).mouseleave(function () {
  //     clearTimeout(timeout)
  //   })
  // })
  // $('.form-reset').click(function () {
  //   $('.hd-form').get(0).reset()
  // })
</script>

@endsection