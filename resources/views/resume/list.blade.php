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
        //editables on first profile page
    $.fn.editable.defaults.mode = 'inline';
    $(document).ready(function(){
        $('#dynamic-table').DataTable({
            language: {
                url: '{{ asset('static/localisation/Chinese.json') }}'
            },
            processing: true,
            serverSide: true,
            ajax: '{{ route('resume.search', $type) }}',
            columns: [
                {
                    data: 'sn',
                    render: function (data, type, row )
                    {
                        return "<a href='{{ asset('/resume')}}/" + row.id+ "'>" + data +"</a>";
                    }
                },
                {data: 'name'},
                {data: null, defaultContent: '摘要'},
                {data: 'mobile'},
                {data: 'email'},
                {
                    data: 'feedback',
                    defaultContent: '新增反馈',
                    render: function (data, type, row)
                    {
                        if(!data)
                        {
                            data = '新增反馈';
                        }
                        return "<span class='editable editable-click' id='feedback[" + row.id + "]' data-name='text' data-emptytext='新增反馈' data-type='text' data-url='/resume/feedback' data-pk='"+row.id+"'>"+data +"</span>";
                    }
                },
                {
                    data: null,
                    defaultContent: '职位简历库'
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
                                              "<a href='{{ asset('/resume') }}/" + row.id + "'>"+
                                              "<i class='blue ace-icon fa fa-eye bigger-120'></i>查看 </a>" + 
                                          "</li>" + 
                                          "<li>" + 
                                              "<a href='{{ asset('/resume/') }}/" + row.id + "#resume-tab-4') }}'>" + 
                                              "<i class='blue ace-icon fa fa-bell-o bigger-120'></i>" + 
                                               "提醒 </a>" + 
                                          "</li>" + 
                                          "<li>" +
                                              "<a href='#'>" + 
                                              "<i class='blue ace-icon fa fa-download bigger-120'></i>" + 
                                               "加入我的简历库 </a>"+ 
                                          "</li>" + 
                                          "<li>" +
                                              "<a href='#'>" + 
                                              "<i class='blue ace-icon fa fa-plus-square bigger-120'></i>" + 
                                               "加入职位简历库 </a>" +
                                          "</li>" + 
                                          "<li>" + 
                                              "<a href='#'>" +
                                              "<i class='blue ace-icon fa fa-plus-circle bigger-120'></i>" +
                                               "重新加入工作台 </a>" +
                                          "</li>" + 
                                      "</ul>" +
                                  "</div>";
                }}
        ]
        });


$('#dynamic-table tbody').on('click','span[id^=feedback]', function (e) {  
                             $(this).editable({
                params: {'_token' : '{{ csrf_token() }}'},
                validate: function(value) {
                    if($.trim(value) == '') {
                        return '反馈不能为空！';
                    }
                }

            });
            } );
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
            简历列表
        </div>

        <!-- 简历列表--开始 -->
        <div>
            <table id='dynamic-table' class="table table-striped table-bordered table-hover" style="width: 100%">
                <thead>
                    <tr>
{{--                         <th class="center">
                            <label class="pos-rel">
                                <input type="checkbox" class="ace" />
                                <span class="lbl"></span>
                            </label>
                        </th> --}}
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
{{--                 <tbody>
                    @foreach($resumes as $resume)
                    <tr>
                        <td class="center">
                            <label class="pos-rel">
                                <input type="checkbox" class="ace" />
                                <span class="lbl"></span>
                            </label>
                        </td>
                        <td><a href="{{ asset('/resume/'.$resume->id) }}">{{ $resume->sn }}</a></td>
                        <td>{{ $resume->name }}</td>
                        <td>摘要</td>
                        <td>{{ $resume->mobile }}</td>
                        <td>{{ $resume->email }}</td>
                        <td><span class="editable editable-click" id="feedback[{{ $resume->id }}]" data-name="text" data-emptytext='新增反馈' data-type='text' data-url='/resume/feedback' data-pk="{{ $resume->id }}">{{ $resume->feedback }}
  {{--{{ route('serie/quick_update', $serie->id) }}   {{ nl2br($serie->video) }}  --}}
{{-- </span></td>
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
                                        <a href="{{ asset('/resume/'.$resume->id) }}">
                                        <i class="blue ace-icon fa fa-eye bigger-120"></i>
                                         查看 </a>
                                    </li>
                                    <li>
                                        <a href="{{ asset('/resume/'.$resume->id.'#resume-tab-4') }}">
                                        <i class="blue ace-icon fa fa-bell-o bigger-120"></i>
                                         提醒 </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                        <i class="blue ace-icon fa fa-download bigger-120"></i>
                                         加入我的简历库 </a>
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
                </tbody> --}}
            </table>
        </div>
        <!-- 简历列表--结束 -->
    </div>
</div>

<!-- PAGE CONTENT ENDS -->
</div><!-- /.col -->
</div>



