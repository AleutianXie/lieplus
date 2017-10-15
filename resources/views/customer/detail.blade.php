@extends('layouts.cici')

@section('title'){{ $title }}@endsection

@section('stylesheet')
<link rel="stylesheet" href="{{ asset('static/css/select2.min.css') }}" />
<link rel="stylesheet" href="{{ asset('static/css/ace.min.css') }}" />
@endsection

@section('content')
<div class="profile-user-info profile-user-info-striped">
    <div class="profile-info-row">
        <div class="profile-info-name"> 公司全称 </div>

        <div class="profile-info-value">
            <span class="editable editable-click" id="name" style="display: inline;">{{ $customer->name }}</span>
        </div>
    </div>
    <div class="profile-info-row">
        <div class="profile-info-name"> 工作地点 </div>

        <div class="profile-info-value">
            <i class="fa fa-map-marker light-orange bigger-110"></i>
            <span class="editable editable-click editable-unsaved" id="country" style="display: inline; background-color: rgba(0, 0, 0, 0);">{{ App\Region::name($customer->province) }}</span>
            <span class="editable editable-click editable-unsaved" style="display: inline; background-color: rgba(0, 0, 0, 0);" id="city">{{ App\Region::name($customer->city) }}</span>
            <span class="editable editable-click editable-unsaved" style="display: inline; background-color: rgba(0, 0, 0, 0);" id="county">{{ App\Region::name($customer->county) }}</span>
        </div>
    </div>
    <div class="profile-info-row">
        <div class="profile-info-name"> 薪资福利 </div>
        <div class="profile-info-value">
            <span class="editable editable-click" id="welfare" style="display: inline;">{{ $customer->welfare }}</span>
        </div>
    </div>
    <div class="profile-info-row">
        <div class="profile-info-name"> 上班时间 </div>
        <div class="profile-info-value">
            <span class="editable editable-click" id="worktime" style="display: inline;">{{ $customer->worktime }}</span>
        </div>
    </div>

    <div class="profile-info-row">
        <div class="profile-info-name"> 公司创始人 </div>
        <div class="profile-info-value">
            <span class="editable editable-click" id="founder" style="display: inline;">{{ $customer->founder }}</span>
        </div>
    </div>

    <div class="profile-info-row">
        <div class="profile-info-name"> 融资记录 </div>
        <div class="profile-info-value">
            <span class="editable editable-click" id="financing" style="display: inline;">{{ $customer->financing }}</span>
        </div>
    </div>

    <div class="profile-info-row">
        <div class="profile-info-name"> 所属行业 </div>
        <div class="profile-info-value">
            <span class="editable editable-click" id="industry" style="display: inline;">{{ $customer->industry }}</span>
        </div>
    </div>

    <div class="profile-info-row">
        <div class="profile-info-name"> 行业排名 </div>
        <div class="profile-info-value">
            <span class="editable editable-click" id="ranking" style="display: inline;">{{ $customer->ranking }}</span>
        </div>
    </div>

    <div class="profile-info-row">
        <div class="profile-info-name"> 公司性质 </div>
        <div class="profile-info-value">
            <span class="editable editable-click" id="property" style="display: inline;">{{ $customer->property }}</span>
        </div>
    </div>

    <div class="profile-info-row">
        <div class="profile-info-name"> 公司规模 </div>
        <div class="profile-info-value">
            <span class="editable editable-click" id="size" style="display: inline;">{{ $customer->size }}</span>
        </div>
    </div>

    <div class="profile-info-row">
        <div class="profile-info-name"> 公司介绍 </div>
        <div class="profile-info-value" style="max-width: 900px; overflow:scroll;">
            <span class="editable editable-click" id="introduce" style="display: inline; background-color: rgba(0, 0, 0, 0);">{!! $customer->introduce !!}</span>
        </div>
    </div>

    <div class="hr hr-dotted"></div>
    <div class="profile-info-row">
        <div class="profile-info-name"> 等级 </div>
        <div class="profile-info-value">
            <span class="editable editable-click" id="level" style="display: inline;">{{ $customer->level }}</span>
        </div>
    </div>
    <div class="profile-info-row">
        <div class="profile-info-name"> 公司类型 </div>
        <div class="profile-info-value">
            <span class="editable editable-click" id="type" style="display: inline;">{{ $customer->type }}</span>
        </div>
    </div>
{{--     <div class="form-group">
        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="state">审核:</label>
        <div class="col-xs-12 col-sm-9">
            <button class="btn btn-lg btn-success">
                <i class="ace-icon fa fa-check"></i>
                通过
            </button>
            <button class="btn btn-lg btn-danger">
                <i class="ace-icon fa fa-times"></i>
                拒绝
            </button>
        </div>
    </div> --}}
</div>

@endsection

@section('breadcrumbs')
{!! Breadcrumbs::render('customer.detail', $customer->id) !!}
@endsection

@section('scripts')
<script type="text/javascript">
jQuery(function($) {

});
</script>
@endsection