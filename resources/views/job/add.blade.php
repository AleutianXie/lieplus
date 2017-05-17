@extends('layouts.cici')
@section('title'){{ $title }}@endsection

@section('stylesheet')
<link rel="stylesheet" href="{{ asset('static/css/select2.min.css') }}" />
<link rel="stylesheet" href="{{ asset('static/css/bootstrap-editable.min.css') }}" />
@endsection

@section('content')
<div class="widget-box">
    <div class="widget-header widget-header-blue widget-header-flat">
        <h4 class="widget-title lighter">职位信息</h4>
    </div>

    <div class="widget-body">
        <div class="widget-main">
            <form class="form-horizontal" id="customer-form" name="customer-form" action="{{ url('/project') }}" method="POST">
<input type="hidden" name="_token" value="{{ csrf_token() }}"/>
<div class="step-pane" data-step="2">
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="comment">请选择客户:</label>

        <div class="col-xs-12 col-sm-9">
            <select name="cid" id="cid" class="col-xs-12 col-sm-4">
                <option></option>
                @foreach($assignedCustomers as $key => $value)
                    <option value="{{ $key }}">{{ $value}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="name">职位名称:</label>

        <div class="col-xs-12 col-sm-9">
            <div class="clearfix">
                <input type="text" id="name" name="name" value="{{ old('name') }}" class="col-xs-12 col-sm-5">
            </div>
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

    <div class="form-group text-center">
    <button class="btn btn-primary" type="submit">
    <i class="ace-icon fa fa-plus align-top bigger-125"></i>
    新建
    </button>
    <button class="btn" type="reset">
    <i class="ace-icon fa fa-undo align-top bigger-125"></i>
    重置
    </button>
    </div>
</div>
</form>
</div>
</div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('static/js/jquery-2.1.4.min.js') }}"></script>
<script src="{{ asset('static/js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('static/js/ace.min.js') }}"></script>
<script src="{{ asset('static/js/ace-elements.min.js') }}"></script>
<script src="{{ asset('static/js/select2.min.js') }}"></script>
<script src="{{ asset('static/js/wizard.min.js') }}"></script>
<script src="{{ asset('static/js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('static/js/jquery.form.min.js') }}"></script>
<script type="text/javascript">
jQuery(function($) {

    $('#customer-form').validate({
        errorElement: 'div',
        errorClass: 'help-block',
        focusInvalid: false,
        ignore: "",
        rules: {
            cid: {
                required: true,
            },
            name: {
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
            cid: {
                required: "请选择客户",
            },
            name: {
                required: "请输入公司全称.",
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

    $('#cid').select2({
        placeholder: '请选择客户',
        width: 240
    });

    $("#cid").change(function(){
        $(this).valid();
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