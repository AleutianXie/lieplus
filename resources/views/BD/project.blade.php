@extends('layouts.lieplus')

@section('title'){{ $title }}@endsection

@section('content')
<div class="widget-box">
    <div class="widget-header widget-header-blue widget-header-flat">
        <h4 class="widget-title lighter">项目启动</h4>
    </div>

    <div class="widget-body">
        <div class="widget-main">
            <div id="fuelux-wizard-container" class="no-steps-container">
                <div>
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

                        <form class="form-horizontal" id="validation-form" method="post" novalidate="novalidate">
                            <div class="form-group">
                                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="name">公司全称:</label>

                                <div class="col-xs-12 col-sm-9">
                                    <div class="clearfix">
                                        <input type="text" id="name" name="name" class="col-xs-12 col-sm-5">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="email">工作地点:</label>

                                <div class="col-xs-12 col-sm-9">
                                    <div class="clearfix">
                                        <input type="email" name="email" id="email" class="col-xs-12 col-sm-6">
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
                                        </select>                                    </div>
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

                                        <input type="text" id="founder" name="founder">
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
                                    <select name="companytype" id="companytype" class="col-xs-12 col-sm-4">
                                        @foreach(config('lieplus.companytype') as $value)
                                            <option value="{{ $value['id'] }}" @if($value['id'] == 0) selected="selected" @endif>{{ $value['text'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="state">公司规模:</label>

                                <div class="col-xs-12 col-sm-9">
                                    <select name="companysize" id="companysize" class="col-xs-12 col-sm-4">
                                        @foreach(config('lieplus.companysize') as $value)
                                            <option value="{{ $value['id'] }}" @if($value['id'] == 0) selected="selected" @endif>{{ $value['text'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="hr hr-dotted"></div>

                            <div class="form-group">
                                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="comment">公司介绍:</label>

                                <div class="col-xs-12 col-sm-9">
                                    <div class="clearfix">
                                        <textarea name="comment" id="comment" cols="100" rows="10"></textarea>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="step-pane" data-step="2">
                        <div>
                            <div class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert">
                                    <i class="ace-icon fa fa-times"></i>
                                </button>

                                <strong>
                                    <i class="ace-icon fa fa-check"></i>
                                    Well done!
                                </strong>

                                You successfully read this important alert message.
                                <br>
                            </div>

                            <div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert">
                                    <i class="ace-icon fa fa-times"></i>
                                </button>

                                <strong>
                                    <i class="ace-icon fa fa-times"></i>
                                    Oh snap!
                                </strong>

                                Change a few things up and try submitting again.
                                <br>
                            </div>

                            <div class="alert alert-warning">
                                <button type="button" class="close" data-dismiss="alert">
                                    <i class="ace-icon fa fa-times"></i>
                                </button>
                                <strong>Warning!</strong>

                                Best check yo self, you're not looking too good.
                                <br>
                            </div>

                            <div class="alert alert-info">
                                <button type="button" class="close" data-dismiss="alert">
                                    <i class="ace-icon fa fa-times"></i>
                                </button>
                                <strong>Heads up!</strong>

                                This alert needs your attention, but it's not super important.
                                <br>
                            </div>
                        </div>
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

                    <div class="step-pane" data-step="3">
                        <div class="center">
                            <h3 class="blue lighter">This is step 3</h3>
                        </div>
                    </div>

                    <div class="step-pane" data-step="4">
                        <div class="center">
                            <h3 class="green">Congrats!</h3>
                            Your product is ready to ship! Click finish to continue!
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
        </div><!-- /.widget-main -->
    </div><!-- /.widget-body -->
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('static/js/wizard.min.js') }}"></script>
<script type="text/javascript">
jQuery(function($) {

    var $validation = false;
    $('#fuelux-wizard-container')
    .ace_wizard({
        //step: 2 //optional argument. wizard will jump to step "2" at first
        //buttons: '.wizard-actions:eq(0)'
    })
    .on('actionclicked.fu.wizard' , function(e, info){
        if(info.step == 1 && $validation) {
            if(!$('#validation-form').valid()) e.preventDefault();
        }
    })
    //.on('changed.fu.wizard', function() {
    //})
    .on('finished.fu.wizard', function(e) {
        bootbox.dialog({
            message: "Thank you! Your information was successfully saved!", 
            buttons: {
                "success" : {
                    "label" : "OK",
                    "className" : "btn-sm btn-primary"
                }
            }
        });
        $('.form-horizontal').submit();
    }).on('stepclick.fu.wizard', function(e){
        //e.preventDefault();//this will prevent clicking and selecting steps
    });
});
</script>
@endsection