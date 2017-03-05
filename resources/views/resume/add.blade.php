@extends('layouts.lieplus')
@section('title'){{ $title }}@endsection
@section('stylesheet')
<link rel="stylesheet" href="{{ asset('static/css/select2.min.css') }}" />
<link rel="stylesheet" href="{{ asset('static/css/bootstrap-datepicker3.min.css') }}" />
@endsection

@section('page-header')
<i class="ace-icon fa fa-plus"></i>
{{ $title }}
@endsection

@section('content')
{{-- 创建简历表单--开始 --}}
<form class="form-horizontal" id="validation-form" method="post">
<input type="hidden" name="_token" value="{{ csrf_token() }}"/>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="name">姓名:</label>

        <div class="col-xs-12 col-sm-9">
            <div class="clearfix">
                <input type="text" name="name" id="name" class="col-xs-12 col-sm-6" value="{{ old('name') }}" required />
            </div>
        </div>
    </div>

    <div class="space-2"></div>

    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-3 no-padding-right">性别:</label>

        <div class="col-xs-12 col-sm-9">
            <div>
                <label class="line-height-1 blue">
                    <input name="gender" value="0" type="radio" class="ace" checked="checked" />
                    <span class="lbl"> {{ config('lieplus.gender.0.text') }}</span>
                </label>
                &nbsp;
                <label class="line-height-1 blue">
                    <input name="gender" value="1" type="radio" class="ace" />
                    <span class="lbl"> {{ config('lieplus.gender.1.text') }}</span>
                </label>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="phone">手机:</label>

        <div class="col-xs-12 col-sm-9">
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="ace-icon fa fa-phone"></i>
                </span>

                <input type="tel" id="mobile" name="mobile" value="{{ old('mobile') }}" required pattern="1(3|4|5|7|8)[0-9]{9}"/>
                <span class="red">
                    {{ $errors->first('mobile') }}
                </span>
            </div>
        </div>
    </div>

    <div class="space-2"></div>

    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="email">邮箱:</label>

        <div class="col-xs-12 col-sm-9">
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="ace-icon fa fa-envelope"></i>
                </span>

                <input type="email" name="email" id="email" value="{{ old('email') }}" required />
                <span class="red">
                    {{ $errors->first('email') }}
                </span>
            </div>
        </div>
    </div>

    <div class="space-2"></div>

    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="degree">学历:</label>

        <div class="col-xs-12 col-sm-9">
            <div class="clearfix">
                <select name="degree" id="degree" class="col-xs-12 col-sm-4">
                    @foreach(config('lieplus.degree') as $value)
                        <option value="{{ $value['id'] }}" @if($value['id'] == 1) selected="selected" @endif>{{ $value['text'] }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="space-2"></div>

    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="state">城市:</label>

        <div class="col-xs-12 col-sm-9">
            <select id="province" name="province" required>
                <option></option>
            </select>
            <select id="city" name="city" required>
                <option></option>
            </select>
            <select id="county" name="county" required>
                <option></option>
            </select>
        </div>
    </div>

    <div class="space-2"></div>

    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="birthdate">出生日期:</label>

        <div class="col-xs-12 col-sm-9">
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="ace-icon fa fa-calendar"></i>
                </span>

                <input type="date" name="birthdate" id="birthdate" class="col-xs-12 col-sm-4" value="{{ old('birthdate') }}" required max="{{ date('Y-m-d', time()) }}"/>
                <span class="red">
                    {{ $errors->first('birthdate') }}
                </span>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="startworkdate">开始工作日期:</label>

        <div class="col-xs-12 col-sm-9">
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="ace-icon fa fa-calendar"></i>
                </span>

                <input type="date" name="startworkdate" id="startworkdate" class="col-xs-12 col-sm-4" value="{{ old('startworkdate') }}" max="{{ date('Y-m-d', time()) }}" min="{{ date('Y-m-d', strtotime('-20 years')) }}" required />
                <span class="red">
                    {{ $errors->first('startworkdate') }}
                </span>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="servicestatus">当前状态:</label>

        <div class="col-xs-12 col-sm-9">
            <div class="clearfix">
                <select name="servicestatus" id="servicestatus" class="col-xs-12 col-sm-4">
                    @foreach(config('lieplus.servicestatus') as $value)
                        <option value="{{ $value['id'] }}" @if($value['id'] == 0) selected="selected" @endif>{{ $value['text'] }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="industry">当前行业:</label>

        <div class="col-xs-12 col-sm-9">
            <div class="clearfix">
                <input type="text" name="industry" id="industry" class="col-xs-12 col-sm-6" value="{{ old('industry') }}" />
            </div>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="position">当前职位:</label>

        <div class="col-xs-12 col-sm-9">
            <div class="clearfix">
                <input type="text" name="position" id="position" class="col-xs-12 col-sm-6" value="{{ old('position') }}" />
            </div>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="salary">期望薪资:</label>

        <div class="col-xs-12 col-sm-9">
            <div class="clearfix">
                <select name="salary" id="salary" class="col-xs-12 col-sm-4">
                    @foreach(config('lieplus.salary') as $value)
                        <option value="{{ $value['id'] }}" @if($value['id'] == 0) selected="selected" @endif>{{ $value['text'] }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="joblibaray">职位简历库:</label>

        <div class="col-xs-12 col-sm-9">
            <div class="clearfix">
                <select name="joblibaray" id="joblibaray" class="col-xs-12 col-sm-4">
                <option></option>
                @foreach(config('lieplus.salary') as $value)
                    <option value="{{ $value['id'] }}">{{ $value['text'] }}</option>
                @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="hr hr-dotted"></div>

    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="others"><b>其它:</b></label>

        <div class="col-xs-12 col-sm-9">
            <input name="others" type="hidden" id="others"/>
            <div class="wysiwyg-editor" style="min-height: 400px;" name="others-editor" id="others-editor">
            </div>
        </div>
    </div>
    <div class="form-group text-center">
    <button class="btn btn-primary" type="submit" onClick="updateText();">
    <i class="ace-icon fa fa-plus align-top bigger-125"></i>
    新建
    </button>
    <button class="btn" type="reset">
    <i class="ace-icon fa fa-undo align-top bigger-125"></i>
    重置
    </button>
    </div>
</form>
{{-- 创建简历表单--结束 --}}
@endsection

@section('scripts')
<script src="{{ asset('static/js/select2.min.js') }}"></script>
<script src="{{ asset('static/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('static/js/jquery.hotkeys.index.min.js') }}"></script>
<script src="{{ asset('static/js/bootstrap-wysiwyg.min.js') }}"></script>
<script src="{{ asset('static/js/bootstrap-editable.min.js') }}"></script>
<script type="text/javascript">
    $('#degree').select2({
        minimumResultsForSearch: Infinity,
    });

    // $('#birthdate').datepicker({
    //     format: 'yyyy-mm-dd',
    // });

    // $('#startworkdate').datepicker({
    //     format: 'yyyy-mm-dd',
    // });

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

    $('#servicestatus').select2({
        minimumResultsForSearch: Infinity,
    });

    $('#salary').select2({
        minimumResultsForSearch: Infinity,
    });

    $('#joblibaray').select2({
        placeholder: "请选择职位简历库",
        allowClear: true,
    });

    $('#others-editor').ace_wysiwyg({
        toolbar:
        [
            'font',
            null,
            'fontSize',
            null,
            {name:'bold', className:'btn-info'},
            {name:'italic', className:'btn-info'},
            {name:'strikethrough', className:'btn-info'},
            {name:'underline', className:'btn-info'},
            null,
            {name:'insertunorderedlist', className:'btn-success'},
            {name:'insertorderedlist', className:'btn-success'},
            {name:'outdent', className:'btn-purple'},
            {name:'indent', className:'btn-purple'},
            null,
            {name:'justifyleft', className:'btn-primary'},
            {name:'justifycenter', className:'btn-primary'},
            {name:'justifyright', className:'btn-primary'},
            {name:'justifyfull', className:'btn-inverse'},
            null,
            {name:'createLink', className:'btn-pink'},
            {name:'unlink', className:'btn-pink'},
            null,
            {name:'insertImage', className:'btn-success'},
            null,
            'foreColor',
            null,
            {name:'undo', className:'btn-grey'},
            {name:'redo', className:'btn-grey'}
        ],
        'wysiwyg': {
            fileUploadError: showErrorAlert
        }
    }).prev().addClass('wysiwyg-style2');

    function showErrorAlert (reason, detail) {
        var msg='';
        if (reason==='unsupported-file-type') { msg = "Unsupported format " +detail; }
        else {
            //console.log("error uploading file", reason, detail);
        }
        $('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>'+
         '<strong>File upload error</strong> '+msg+' </div>').prependTo('#alerts');
    }

    function updateText() {
        //alert($('#others-editor').html());return;
        $('#others').val($('#others-editor').html());
    }
</script>
@endsection