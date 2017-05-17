@extends('layouts.lieplus')
@section('title'){{ $title }}@endsection

@section('stylesheet')
<link rel="stylesheet" href="{{ asset('static/css/select2.min.css') }}" />
<link rel="stylesheet" href="{{ asset('static/css/bootstrap-editable.min.css') }}" />
@endsection

@section('content')
<div class="widget-box">
    <div class="widget-header widget-header-blue widget-header-flat">
        <h4 class="widget-title lighter">新建客户</h4>
    </div>
<div class="widget-body">
<div class="widget-main">
<form class="form-horizontal" id="customer-form" name="customer-form" action="{{ url('/project') }}" method="POST">
<input type="hidden" name="_token" value="{{ csrf_token() }}"/>
<div class="step-content pos-rel">
<div class="step-pane active" data-step="1">
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="name">公司全称:</label>

        <div class="col-xs-12 col-sm-9">
            <div class="clearfix">
                <input type="text" id="name" name="name" value="{{ old('name') }}" class="col-xs-12 col-sm-5">
            </div>
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
</div>
</form>
</div>
</div>
</div>
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
        if(!($('#requirement').valid()
            && $('#salary').valid())) {
            e.preventDefault();
        }

        $('#customer-form').ajaxSubmit({
            success:function(msg) {
                alert(msg);return;
                $('.customer-warning').html('该邮箱尚未注册！');

                $('.customer-warning').removeClass('hide').dialog();
                // if (msg == 1) {
                //     $('.customer-warning').html('该邮箱尚未注册！');
                //     $('.customer-warning').show();
                // }
            }
        });

    }).on('stepclick.fu.wizard', function(e){
        //e.preventDefault();//this will prevent clicking and selecting steps
    });


    $('#customer-form').validate({
        errorElement: 'div',
        errorClass: 'help-block',
        focusInvalid: false,
        ignore: "",
        rules: {
            name: {
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
    $.each({!! json_encode($provinces) !!}, function(k, v) {
        provinces.push({id: k, text: v});
    });

    var cities = [];
    @foreach ($cities as $key => $value)
        cities[{{ $key }}] = [];
        $.each({!! json_encode($value) !!}, function(k, v){
            cities[{{ $key }}].push({id: k, text: v});
        });
    @endforeach

    var counties = [];
    @foreach ($counties as $key => $value)
        counties[{{ $key }}] = [];
        $.each({!! json_encode($value) !!}, function(k, v){
            counties[{{ $key }}].push({id: k, text: v});
        });
    @endforeach

    $('#province').select2({
        data: provinces,
        placeholder: '请选择省',
        width: 140
    });

    $('#city').select2({
        placeholder: '请选择市',
        width: 140
    });

    $('#county').select2({
        placeholder: '请选择县',
        width: 140
    });

    $('#province').on('select2:select', function(evt) {
        $('#city').find("option").remove();
        $('#city').select2({
            data: cities[$(this).val()],
            width: 140
        });
        $('#county').find("option").remove();
        $('#county').select2({
            data: counties[$('#city').val()],
            width: 140
        });
    });

    $('#city').on('select2:select', function (evt) {
        $('#county').find("option").remove();
        $('#county').select2({
            data: counties[$(this).val()],
            width: 140
        });
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
});
</script>
@endsection