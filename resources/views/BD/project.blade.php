@extends('layouts.cici')

@section('title'){{ $title }}@endsection
@section('stylesheet')
<link rel="stylesheet" href="{{ asset('static/css/select2.min.css') }}" />
<link rel="stylesheet" href="{{ asset('static/css/ace.min.css') }}" />
@endsection

@section('content')
<div class="widget-box">
    <div class="widget-header widget-header-blue widget-header-flat">
        <h4 class="widget-title lighter">项目启动</h4>
    </div>

    <div class="widget-body">
        <div class="widget-main">
            <form class="form-horizontal" id="customer-form" name="customer-form" action="{{ url('/project') }}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                <div id="fuelux-wizard-container" class="no-steps-container">
                    <div class="steps-container">
                        <ul class="steps" style="margin-left: 0">
                            <li data-step="1" class="active">
                                <span class="step">1</span>
                                <span class="title">公司介绍</span>
                            </li>

                            <li data-step="2">
                                <span class="step">2</span>
                                <span class="title">职位描述</span>
                            </li>
                        </ul>
                    </div>

                    <hr>
                    <div class="step-content pos-rel">
                        <div class="step-pane active" data-step="1">
                            <h3 class="lighter block green">请输入公司相关信息</h3>
                            <div class="form-group">
                                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="name">公司全称:</label>

                                <div class="col-xs-12 col-sm-9">
                                    <div class="clearfix">
                                        <input type="text" id="name" name="name" value="{{ old('name') }}" class="col-xs-12 col-sm-5">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="department">部门:</label>

                                <div class="col-sm-9">
                                    <!-- #section:plugins/input.tag-input -->
                                    <div class="inline">
                                        <input type="text" name="department" id="department" value="" placeholder="请输入部门..." />
                                    </div>

                                    <!-- /section:plugins/input.tag-input -->
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="state">工作地点:</label>

                                <div class="col-xs-12 col-sm-9">
                                    <div class="clearfix">
                                        <select id="province" class="select2" name="province">
                                            <option></option>
                                        </select>
                                        <select id="city" class="select2" name="city">
                                            <option></option>
                                        </select>
                                        <select id="county" class="select2" name="county">
                                            <option></option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="space-2"></div>

                            <div class="form-group">
                                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="password">薪资福利:</label>

                                <div class="col-xs-12 col-sm-9">
                                    <div class="clearfix">
                                        <select name="welfare" id="welfare" class="col-xs-12 col-sm-4">
                                            @foreach(config('lieplus.welfare') as $value)
                                                <option value="{{ $value['id'] }}" @if($value['id'] == 0) selected="selected" @endif>{{ $value['text'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="space-2"></div>

                            <div class="form-group">
                                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="password2">上班时间:</label>

                                <div class="col-xs-12 col-sm-9">
                                    <div class="clearfix">
                                        <select name="worktime" id="worktime" class="col-xs-12 col-sm-4">
                                            @foreach(config('lieplus.worktime') as $value)
                                                <option value="{{ $value['id'] }}" @if($value['id'] == 0) selected="selected" @endif>{{ $value['text'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="hr hr-dotted"></div>

                            <div class="space-2"></div>

                            <div class="form-group">
                                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="phone">公司创始人:</label>

                                <div class="col-xs-12 col-sm-9">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="ace-icon fa fa-user"></i>
                                        </span>

                                        <input type="text" id="founder" name="founder" value="{{ old('founder') }}">
                                    </div>
                                </div>
                            </div>

                            <div class="space-2"></div>

                            <div class="form-group">
                                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="url">融资记录:</label>

                                <div class="col-xs-12 col-sm-9">
                                    <div class="clearfix">
                                        <select name="financing" id="financing" class="col-xs-12 col-sm-4">
                                            @foreach(config('lieplus.financing') as $value)
                                                <option value="{{ $value['id'] }}" @if($value['id'] == 0) selected="selected" @endif>{{ $value['text'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="name">所属行业:</label>

                                <div class="col-xs-12 col-sm-9">
                                    <div class="clearfix">
                                        <select name="industry" id="industry" class="col-xs-12 col-sm-4">
                                            @foreach(config('lieplus.industry') as $value)
                                                <option value="{{ $value['id'] }}" @if($value['id'] == 0) selected="selected" @endif>{{ $value['text'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="name">行业排名:</label>

                                <div class="col-xs-12 col-sm-9">
                                    <div class="clearfix">
                                        <select name="ranking" id="ranking" class="col-xs-12 col-sm-4">
                                            @foreach(config('lieplus.ranking') as $value)
                                                <option value="{{ $value['id'] }}" @if($value['id'] == 0) selected="selected" @endif>{{ $value['text'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="state">公司性质:</label>

                                <div class="col-xs-12 col-sm-9">
                                    <select name="property" id="property" class="col-xs-12 col-sm-4">
                                        @foreach(config('lieplus.companyproperty') as $value)
                                            <option value="{{ $value['id'] }}" @if($value['id'] == 0) selected="selected" @endif>{{ $value['text'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="state">公司规模:</label>

                                <div class="col-xs-12 col-sm-9">
                                    <select name="size" id="size" class="col-xs-12 col-sm-4">
                                        @foreach(config('lieplus.companysize') as $value)
                                            <option value="{{ $value['id'] }}" @if($value['id'] == 0) selected="selected" @endif>{{ $value['text'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="hr hr-dotted"></div>

                            <div class="form-group">
                                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="introduce">公司介绍:</label>

                                <div class="col-xs-12 col-sm-9">
                                    <div class="clearfix">
                                        <textarea name="introduce" id="introduce" cols="100" rows="10" value="{{ old('introduce') }}"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="step-pane" data-step="2">
                            <div>
                                <div class="alert hide">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="job_name">职位名称:</label>

                                <div class="col-xs-12 col-sm-9">
                                    <div class="clearfix">
                                        <input type="text" id="job_name" name="job_name" value="{{ old('job_name') }}" class="col-xs-12 col-sm-5" placeholder="请输入职位名称...">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="job_department">招聘部门:</label>

                                <div class="col-xs-12 col-sm-9">
                                    <!-- #section:plugins/input.tag-input -->
                                    <div class="clearfix">
                                        <input type="text" name="job_department" id="job_department" value="{{ old('job_name') }}" class="col-xs-12 col-sm-5" placeholder="请输入部门..." />
                                    </div>

                                    <!-- /section:plugins/input.tag-input -->
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="comment">任职要求(JD):</label>

                                <div class="col-xs-12 col-sm-9">
                                    <div class="clearfix">
                                        <textarea name="requirement" id="requirement" value="{{ old('requirement') }}" cols="100" rows="10"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="hr hr-dotted"></div>
                            <div class="form-group">
                                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="comment">总工作年限:</label>

                                <div class="col-xs-12 col-sm-9">
                                    <select name="workyears" id="workyears" class="col-xs-12 col-sm-4">
                                        <option value="0"></option>
                                        @foreach(config('lieplus.workyears') as $value)
                                            <option value="{{ $value['id'] }}" @if($value['id'] == 0) selected="selected" @endif>{{ $value['text'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="comment">性别要求:</label>

                                <div class="col-xs-12 col-sm-9">
                                    <select name="gender" id="gender" class="col-xs-12 col-sm-4">
                                        <option value="0"></option>
                                        @foreach(config('lieplus.gender') as $value)
                                            <option value="{{ $value['id'] }}">{{ $value['text'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="comment">专业要求:</label>

                                <div class="col-xs-12 col-sm-9">
                                    <select name="majors" id="majors" class="col-xs-12 col-sm-4">
                                        <option value="0"></option>
                                        @foreach(config('lieplus.majors') as $value)
                                            <option value="{{ $value['id'] }}" @if($value['id'] == 0) selected="selected" @endif>{{ $value['text'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="comment">学历要求:</label>

                                <div class="col-xs-12 col-sm-9">
                                    <select name="degree" id="degree" class="col-xs-12 col-sm-4">
                                        <option value="0"></option>
                                        @foreach(config('lieplus.degree') as $value)
                                        <option value="{{ $value['id'] }}">{{ $value['text'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="comment">是否统招全日制:</label>

                                <div class="col-xs-12 col-sm-9">
                                    <label>
                                        <input id="unified" name="unified" type="checkbox" class="ace ace-switch ace-switch-4" value="1">
                                        <span class="lbl middle" data-lbl="是&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;否"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="hr hr-dotted"></div>
                            <div class="form-group">
                                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="comment">薪酬结构:</label>

                                <div class="col-xs-12 col-sm-9">
                                    <div class="clearfix">
                                        <textarea name="salary" id="salary" cols="100" rows="10" value="{{ old('salary') }}"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="wizard-actions">
                    <button class="btn btn-prev" disabled="disabled">
                        <i class="ace-icon fa fa-arrow-left"></i>
                        上一步
                    </button>

                    <button class="btn btn-success btn-next" data-last="完成">
                        下一步
                        <i class="ace-icon fa fa-arrow-right icon-on-right"></i>
                    </button>
                </div>
            </form>
            <div class="customer-warning hide"></div>
        </div><!-- /.widget-main -->
    </div><!-- /.widget-body -->
</div>
@endsection

@section('breadcrumbs')
{!! Breadcrumbs::render('project') !!}
@endsection

@section('scripts')
<script src="{{ asset('static/js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('static/js/select2.min.js') }}"></script>
<script src="{{ asset('static/js/wizard.min.js') }}"></script>
<script src="{{ asset('static/js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('static/js/jquery.form.min.js') }}"></script>
<script type="text/javascript">
jQuery(function($) {

    $('#fuelux-wizard-container')
    .ace_wizard({
        //step: 2 //optional argument. wizard will jump to step "2" at first
        //buttons: '.wizard-actions:eq(0)'
    })
    .on('actionclicked.fu.wizard' , function(e, info){
        if(info.step == 1
            && !($('#name').valid()
                && $('#province').valid()
                && $('#city').valid()
                && $('#county').valid()
                && $('#introduce').valid())) e.preventDefault();
    })
    .on('finished.fu.wizard', function(e) {
        if(!($('#job_name').valid()
            && $('#requirement').valid()
            && $('#salary').valid())) {
            e.preventDefault();
        }

        $('#customer-form').ajaxSubmit({
            success:function(msg) {

                if (msg >= 1) {
                    $('.alert').removeClass('hide').addClass('alert-success').html(
                        '<strong>' +
                        '<i class="ace-icon fa fa-check"></i>创建成功!</strong>'+
                        '点击 <a class="blue bolder" href="/project/' + msg + '">前往</a> 查看详情.<br>');
                } else {
                    $('.alert').removeClass('hide').addClass('alert-danger').html(
                        '<strong>' +
                        '<i class="ace-icon fa fa-times"></i>创建失败!</strong>' +
                        '请检查信息重新提交，若再有问题请联系管理员。<br></div>');
                }
            }
        });

    }).on('stepclick.fu.wizard', function(e){
        //e.preventDefault();//this will prevent clicking and selecting steps
    });


    $('#customer-form').validate({
        //debug: true,
        errorElement: 'div',
        errorClass: 'help-block',
        focusInvalid: false,
        ignore: "",
        rules: {
            name: {
                required: true,
                remote: {
                    type:"POST",
                    url:"/customer/check",
                    data:{
                        'name': function () { return $("#name").val() },
                        '_token': '{{ csrf_token() }}',
                    },
                dataFilter: function (data, type) {
                    if (data == "true") { return false; }
                    else { return true; }
                }
                }
            },
            department: {
                required: true,
            },
            province: {
                required: true,
            },
            city: {
                required: true,
            },
            county: {
                required: true,
            },
            introduce: {
                required: true,
            },
            job_name: {
                required: true,
            },
            job_department: {
                required: true,
                inarray: true,
            },
            requirement: {
                required: true,
            },
            salary: {
                required: true,
            }
        },

        messages: {
            name: {
                required: "请输入公司全称.",
                remote: "该客户已经存在.",
            },
            department: {
                required: "请输入招聘部门."
            },
            province: {
                required: "请选择省.",
            },
            city: {
                required: "请选择市.",
            },
            county: {
                required: "请选择县.",
            },
            introduce: "请输入公司介绍.",
            job_name: {
                required: "请输入职位名称.",
            },
            job_department: {
                required: "请输入招聘部门.",
                inarray: "不存在的部门",
            },
            requirement: {
                required: "请输入任职要求.",
            },
            salary: {
                required: "请输入薪酬结构.",
            }
        },


        highlight: function (e) {
            $(e).closest('.form-group').removeClass('has-info').addClass('has-error');
        },

        success: function (e) {
            $(e).closest('.form-group').removeClass('has-error');//.addClass('has-info');
            $(e).remove();
        },

        errorPlacement: function (error, element) {
            if(element.is('input[type=checkbox]') || element.is('input[type=radio]')) {
                var controls = element.closest('div[class*="col-"]');
                if(controls.find(':checkbox,:radio').length > 1) controls.append(error);
                else error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
            }
            else if(element.is('.select2')) {
                error.insertAfter(element.siblings('[class*="select2-container"]:last()'));
            }
            else if(element.is('.chosen-select')) {
                error.insertAfter(element.siblings('[class*="chosen-container"]:eq(0)'));
            }
            else error.insertAfter(element.parent());
        },

        submitHandler: function (form) {
        },
        invalidHandler: function (form) {
        }
    });

    var provinces = [];
    $.each({!! json_encode(config('lieplus.provinces')) !!}, function(k, v) {
        provinces.push({id: k, text: v});
    });

    var cities = [];
    $.each({!! json_encode(config('lieplus.cities')) !!}, function(key, value) {
        cities[key] = [];
        $.each(value, function(k, v){
            cities[key].push({id: k, text: v});
        });
    });

    var counties = [];
    $.each({!! json_encode(config('lieplus.counties')) !!}, function(key,value) {
        counties[key] = [];
        $.each(value, function(k, v) {
            counties[key].push({id: k, text: v});
        });
    });

    $('#province').select2({
        data: provinces,
        placeholder: '请选择省',
        width: 140
    });

    $("#province").change(function(){
        $(this).valid();
    });

    $('#city').select2({
        placeholder: '请选择市',
        width: 140
    });

    $("#city").change(function(){
        $(this).valid();
    });

    $('#county').select2({
        placeholder: '请选择县',
        width: 140
    });

    $("#county").change(function(){
        $(this).valid();
    });

    $('#province').on('select2:select', function(evt) {
        $('#city').find("option").remove();
        $('#city').select2({
            data: cities[$(this).val()],
            width: 140
        });
        $("#city").valid();
        $('#county').find("option").remove();
        $('#county').select2({
            data: counties[$('#city').val()],
            width: 140
        });
        $("#county").valid();
    });

    $('#city').on('select2:select', function (evt) {
        $('#county').find("option").remove();
        $('#county').select2({
            data: counties[$(this).val()],
            width: 140
        });
        $("#county").valid();
    });

    $('#welfare').select2({
        width: 140
    });

    $('#worktime').select2({
        width: 140
    });

    $('#financing').select2({
        width: 140
    });

    $('#industry').select2({
        width: 140
    });

    $('#ranking').select2({
        width: 140
    });

    $('#property').select2({
        width: 160
    });

    $('#size').select2({
        width: 140
    });

    $('#workyears').select2({
        placeholder: {
            id: 0,
            text: '不限'
        },
        width: 140
    });

    $('#gender').select2({
        placeholder: {
            id: 0,
            text: '不限'
        },
        width: 140
    });

    $('#majors').select2({
        placeholder: {
            id: 0,
            text: '不限'
        },
        width: 140
    });

    $('#degree').select2({
        placeholder: {
            id: 0,
            text: '不限'
        },
        width: 140
    });

    var tag_input = $('#department');
    try{
        tag_input.tag(
          {
            placeholder:tag_input.attr('placeholder'),
            //enable typeahead by specifying the source array
            source: ace.vars['US_STATES'],//defined in ace.js >> ace.enable_search_ahead
            /**
            //or fetch data from database, fetch those that match "query"
            source: function(query, process) {
              $.ajax({url: 'remote_source.php?q='+encodeURIComponent(query)})
              .done(function(result_items){
                process(result_items);
              });
            }
            */
          }
        )


        //programmatically add/remove a tag
        //var $tag_obj = $('#department').data('tag');
        //$tag_obj.add('Programmatically Added');

        //var index = $tag_obj.inValues('some tag');
        //$tag_obj.remove(index);
    }
    catch(e) {
        //display a textarea for old IE, because it doesn't support this plugin or another one I tried!
        tag_input.after('<textarea id="'+tag_input.attr('id')+'" name="'+tag_input.attr('name')+'" rows="3">'+tag_input.val()+'</textarea>').remove();
        //autosize($('#department'));
    }

    $('#department').on('added', function (e, value) {
        $(this).valid();
    });

    $('#department').on('removed', function (e, value) {
        $(this).valid();
    });

    $.validator.addMethod('inarray', function (value, element) {
        var arr = $('#department').val().split(', ');
        //console.log(arr);
        return $.inArray($.trim(value), arr) >= 0 ? true : false;
    });
});
</script>
<script src="{{ asset('static/js/bootstrap-tag.js') }}"></script>
<script type="text/javascript"> ace.vars['base'] = '..'; </script>
@endsection