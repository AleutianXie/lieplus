@extends('layouts.cici')
@section('title'){{ $title }}@endsection

@section('stylesheet')
<link rel="stylesheet" href="{{ asset('static/css/select2.min.css') }}" />
@endsection

@section('content')
@include('common.messages')

<div class="widget-box">
    <div class="widget-header widget-header-blue widget-header-flat">
        <h4 class="widget-title lighter">职位信息</h4>
    </div>

    <div class="widget-body">
        <div class="widget-main">
            <form class="form-horizontal" id="customer-form" name="customer-form" action="{{ url('/job/add') }}" method="POST">
<input type="hidden" name="_token" value="{{ csrf_token() }}"/>
<div class="step-pane" data-step="2">
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="cid">请选择客户:</label>

        <div class="col-xs-12 col-sm-9">
            <select name="cid" id="cid" class="col-xs-12 col-sm-4">
                <option></option>
                @foreach($assignedCustomers as $key => $value)
                    <option value="{{ $key }}" @if (old('cid') == $key)
                        selected="selected"
                    @endif>{{ $value}}</option>
                @endforeach
            </select>
            <div class="red">
{{ $errors->first('cid') }}</div>
        </div>
    </div>

    <div class="form-group hide">
        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="did">招聘部门:</label>

        <div class="col-xs-12 col-sm-9">
            <select type="text" id="did" name="did" class="col-xs-12 col-sm-4">
            <option></option>
            </select>
            {{ $errors->first('did') }}</div>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="name">职位名称:</label>

        <div class="col-xs-12 col-sm-9">
            <div class="clearfix">
                <input type="text" id="name" name="name" value="{{ old('name') }}" class="col-xs-12 col-sm-5"><div class="red">
{{ $errors->first('name') }}</div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="comment">任职要求(JD):</label>

        <div class="col-xs-12 col-sm-9">
            <div class="clearfix">
                <textarea name="requirement" id="requirement" value="{{ old('requirement') }}" cols="100" rows="10"></textarea>
            </div>
            <div class="red">{{ $errors->first('requirement') }}</div>
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
                        <div class="red">{{ $errors->first('salary') }}</div>

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
<script src="{{ asset('static/js/ace-elements.min.js') }}"></script>
<script src="{{ asset('static/js/ace.min.js') }}"></script>
<script src="{{ asset('static/js/select2.min.js') }}"></script>
<script src="{{ asset('static/js/bootstrap.min.js') }}"></script>
<script type="text/javascript">
jQuery(function($) {
    var departments = [];
    $.each({!! json_encode(config('lieplus.departments')) !!}, function(key, value) {
        departments[key] = [];
        $.each(value, function(k, v) {
            departments[key].push({id: k, text: v});
        });
    });
    $(document).ready(function(){
        if($('#cid').val() != '')
        {
            $('#did').parents('.form-group').removeClass('hide').find("option").remove();
            $('#did').select2({
                data: departments[$('#cid').val()],
                width: 140
            });
            $('#did').val({{ old('did') }});
        }
    });

    $('#cid').select2({
        placeholder: '请选择客户',
        width: 240
    });

    $('#department').select2({
        placeholder: '请选择招聘部门',
        width: 240
    });

    $('#cid').on('select2:select', function(evt) {
        //alert($('#department').parents('.form-group').html());return;
        $('#did').parents('.form-group').removeClass('hide').find("option").remove();
        //$('#department').find("option").remove();
        $('#did').select2({
            data: departments[$('#cid').val()],
            width: 140
        });
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