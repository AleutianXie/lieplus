@extends('layouts.cici')

@section('title'){{ $title }}@endsection

@section('stylesheet')
<link rel="stylesheet" href="{{ asset('static/css/select2.min.css') }}" />
<link rel="stylesheet" href="{{ asset('static/css/bootstrap-datepicker3.min.css') }}" />
<link rel="stylesheet" href="{{ asset('static/css/bootstrap-editable.min.css') }}" />
<link rel="stylesheet" href="{{ asset('static/css/ace.min.css') }}" />
@endsection

@section('content')
<div class="tabbable">
    <ul class="nav nav-tabs padding-18 tab-size-bigger" id="myTab">
        <li class="">
            <a data-toggle="tab" href="#baseinfo" aria-expanded="false">
                <i class="blue ace-icon fa fa-user bigger-120"></i>
                基础信息
            </a>
        </li>

        <li class="">
            <a data-toggle="tab" href="#password" aria-expanded="false">
                <i class="green ace-icon fa fa-key bigger-120"></i>
                密码
            </a>
        </li>

        <li class="">
            <a data-toggle="tab" href="#settings" aria-expanded="false">
                <i class="purple ace-icon fa fa-cog bigger-120"></i>
                设置
            </a>
        </li>
    </ul>

    <div class="tab-content no-border padding-24">
        {{-- 基础信息--开始 --}}
        <div id="baseinfo" class="tab-pane fade in">
            <div class="row">
                <h4 class="blue pull-left">
                    <i class="ace-icon fa fa-user bigger-110"></i>
                    基础信息
                </h4>
            </div>
            <div class="space-8"></div>

            <div class="user-profile row">
                <div class="col-xs-12 col-sm-3 center">
                    <div>
                        <!-- #section:pages/profile.picture -->
                        <span class="profile-picture">
                            <img id="avatar" class="editable img-responsive editable-click editable-empty" alt="{{ $user->name }}" src="{{ empty($user->profile->avatar) ? asset('static/images/avatars/profile-pic.jpg') : $user->profile->avatar }}" style="display: block;">
                        </span>
                        <!-- /section:pages/profile.picture -->
                        <div class="space-4"></div>

                        <div class="width-80 label label-info label-xlg arrowed-in arrowed-in-right">
                            <div class="inline position-relative">
                                <a href="#" class="user-title-label dropdown-toggle" data-toggle="dropdown">
                                    <i class="ace-icon fa fa-circle light-green"></i>
                                    &nbsp;
                                    <span class="white">{{ $user->name }}</span>
                                </a>

                                <ul class="align-left dropdown-menu dropdown-caret dropdown-lighter">
                                    <li class="dropdown-header"> 更改状态 </li>

                                    <li>
                                        <a href="#">
                                            <i class="ace-icon fa fa-circle green"></i>
                                            &nbsp;
                                            <span class="green">在线</span>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="#">
                                            <i class="ace-icon fa fa-circle red"></i>
                                            &nbsp;
                                            <span class="red">忙碌</span>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="#">
                                            <i class="ace-icon fa fa-circle grey"></i>
                                            &nbsp;
                                            <span class="grey">隐身</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="space-6"></div>

                    <!-- #section:pages/profile.contact -->
                    <div class="profile-contact-info">
                        <div class="profile-contact-links align-left">
                            <a href="#" class="btn btn-link">
                                <i class="ace-icon fa fa-plus-circle bigger-120 green"></i>
                                加为好友
                            </a>
                            <br/>
                            <a href="#" class="btn btn-link">
                                <i class="ace-icon fa fa-envelope bigger-120 pink"></i>
                                发邮件
                            </a>
                            <br/>
                            <a href="#" class="btn btn-link">
                                <i class="ace-icon fa fa-phone-square bigger-120 blue"></i>
                                打电话
                            </a>
                        </div>

                        <div class="space-6"></div>

                        <div class="profile-social-links align-center">
                            <a href="#" class="tooltip-info" title="" data-original-title="Visit my Facebook">
                                <i class="middle ace-icon fa fa-facebook-square fa-2x blue"></i>
                            </a>

                            <a href="#" class="tooltip-info" title="" data-original-title="Visit my Twitter">
                                <i class="middle ace-icon fa fa-twitter-square fa-2x light-blue"></i>
                            </a>

                            <a href="#" class="tooltip-error" title="" data-original-title="Visit my Pinterest">
                                <i class="middle ace-icon fa fa-pinterest-square fa-2x red"></i>
                            </a>
                        </div>
                    </div>

                    <!-- /section:pages/profile.contact -->
                    <div class="hr hr12 dotted"></div>

                    <!-- #section:custom/extra.grid -->
                    <div class="clearfix">
                        <div class="grid2">
                            <span class="bigger-175 blue">25</span>

                            <br>
                            Followers
                        </div>

                        <div class="grid2">
                            <span class="bigger-175 blue">12</span>

                            <br>
                            Following
                        </div>
                    </div>

                    <!-- /section:custom/extra.grid -->
                    <div class="hr hr16 dotted"></div>
                </div>
                <div class="col-xs-12 col-sm-9">
                    <div class="profile-user-info profile-user-info-striped">
                        <div class="profile-info-row">
                            <div class="profile-info-name"> 姓名 </div>
                            <div class="profile-info-value">
                                <span class="editable editable-click" id="username" style="display: inline;">{{ $user->name }}</span>
                            </div>
                        </div>
                        <div class="profile-info-row">
                            <div class="profile-info-name"> 性别 </div>
                            <div class="profile-info-value">
                                <span class="editable editable-click" id="gender" style="display: inline;">{{ isset($user->profile) ? config('lieplus.gender.'.$user->profile->gender.'.text') : '' }}</span>
                            </div>
                        </div>
                        <div class="profile-info-row">
                            <div class="profile-info-name"> 手机 </div>
                            <div class="profile-info-value">
                                <span class="editable editable-click" id="mobile" style="display: inline;">{{ $user->profile->mobile or ''}}</span>
                            </div>
                        </div>
                        <div class="profile-info-row">
                            <div class="profile-info-name"> 邮箱 </div>
                            <div class="profile-info-value">
                                <span class="editable editable-click" id="email" style="display: inline;">{{ $user->email }}</span>
                            </div>
                        </div>

                        <div class="profile-info-row">
                            <div class="profile-info-name"> 出生日期 </div>

                            <div class="profile-info-value">
                                <span class="editable editable-click" id="birthdate">{{ $user->profile->birthdate or ''}}</span>
                            </div>
                        </div>

                        <div class="profile-info-row">
                            <div class="profile-info-name"> 部门 </div>

                            <div class="profile-info-value">
                                <span class="editable editable-click" id="servicestatus">{{ $user->profile->did or ''}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- 基础信息--结束 --}}

        {{-- 密码--开始 --}}
        <div id="password" class="tab-pane fade">
            <h4 class="blue">
                <i class="green ace-icon fa fa-key bigger-110"></i>
                密码
            </h4>

            <div class="space-8"></div>

            <div id="edit-password" class="tab-pane active">
            <div class="space-10"></div>

            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-pass1">新密码</label>

                <div class="col-sm-9">
                    <input type="password" id="form-field-pass1">
                </div>
            </div>

            <div class="space-4"></div>

            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-pass2">确认密码</label>

                <div class="col-sm-9">
                    <input type="password" id="form-field-pass2">
                </div>
            </div>
        </div>
        </div>
        {{-- 密码--结束 --}}
        {{-- 设置--开始 --}}
        <div id="settings" class="tab-pane fade">
            <h4 class="purple">
                <i class="green ace-icon fa fa-key bigger-110"></i>
                设置
            </h4>
        </div>
        {{-- 设置--结束 --}}
   </div>
</div>

@endsection

@section('breadcrumbs')
{!! Breadcrumbs::render('user.profile', $user->id) !!}
@endsection

@section('scripts')
<script src="{{ asset('static/js/select2.min.js') }}"></script>
<script src="{{ asset('static/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('static/js/jquery.hotkeys.index.min.js') }}"></script>
<script src="{{ asset('static/js/bootstrap-wysiwyg.min.js') }}"></script>
<script src="{{ asset('static/js/bootstrap-editable.min.js') }}"></script>
<script src="{{ asset('static/js/ace-editable.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('static/js/address.js') }}"></script>
<script type="text/javascript" src="{{ asset('static/js/jquery.xhashchange.min.js') }}"></script>
<script type="text/javascript">
jQuery(function($) {
    var hash = location.hash;
    var arr = [ "#baseinfo", "#password", "#settings" ];

    $(window).hashchange(function () {
        hash = location.hash;

        if (jQuery.inArray( hash, arr ) == -1 ) {
            hash = "#baseinfo";
            location.hash = hash;
        }

        $('a[href='+hash+']').parent().addClass('active');
        $('a[href='+hash+']').parent().siblings().removeClass('active');
        $(hash).addClass('active');
        $(hash).addClass('in');
        $(hash).siblings().removeClass('active');
        $(hash).siblings().removeClass('in');
    });

    if (jQuery.inArray( hash, arr ) == -1 ) {
        hash = "#baseinfo";
        location.hash = hash;
    }

    $('a[href='+hash+']').parent().addClass('active');
    $('a[href='+hash+']').parent().siblings().removeClass('active');
    $(hash).addClass('active');
    $(hash).addClass('in');
    $(hash).siblings().removeClass('active');
    $(hash).siblings().removeClass('in');

    $(document.body).on("click", ".tabbable a[data-toggle]", function(event) {
        location.hash = this.getAttribute("href");
    });

});
</script>
@endsection