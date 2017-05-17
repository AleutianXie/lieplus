@extends('layouts.lieplus')

@section('title'){{ $title }}@endsection

@section('content')
<div class="widget-box">
    <div class="widget-header widget-header-blue widget-header-flat">
        <h4 class="widget-title lighter">职位描述</h4>
    </div>

    <div class="widget-body">
        <div class="widget-main">
            <div id="fuelux-wizard-container" class="no-steps-container">
                <div class="step-content pos-rel">
                    <div class="step-pane active" data-step="1">
                        <form class="form-horizontal" id="validation-form2" method="get" novalidate="novalidate">
                            <div class="form-group">
                                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="comment">任职要求(JD):</label>

                                <div class="col-xs-12 col-sm-9">
                                    <div class="clearfix">
                                        <textarea name="comment" id="comment" cols="100" rows="10"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="hr hr-dotted"></div>
                            <div class="form-group">
                                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="comment">总工作年限:</label>

                                <div class="col-xs-12 col-sm-9">
                                    <select name="workyears" id="workyears" class="col-xs-12 col-sm-4">
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
                                        <option value=''>不限</option>
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
                                        <option value=''>不限</option>
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
                                        <input id="skip-validation" type="checkbox" class="ace ace-switch ace-switch-4">
                                        <span class="lbl middle" data-lbl="是&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;否"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="hr hr-dotted"></div>
                            <div class="form-group">
                                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="comment">薪酬结构:</label>

                                <div class="col-xs-12 col-sm-9">
                                    <div class="clearfix">
                                        <textarea name="comment" id="comment" cols="100" rows="10"></textarea>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- /.widget-main -->
    </div><!-- /.widget-body -->
</div>
@endsection

@section('scripts')
<script src="{{ asset('static/js/wizard.min.js') }}"></script>
<script type="text/javascript">
jQuery(function($) {

});
</script>
@endsection