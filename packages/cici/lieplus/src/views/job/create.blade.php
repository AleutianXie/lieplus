@extends('Lieplus::layouts.cici')

@section('title', '新建职位')

@section('content')
    @include('Lieplus::common.messages')
    @role('admin|manager|customer')
    <div class="widget-box">
        <div class="widget-header widget-header-blue widget-header-flat">
            <h4 class="widget-title lighter">职位信息</h4>
        </div>

        <div class="widget-body">
            <div class="widget-main">
                <form class="form-horizontal" id="customer-form" name="customer-form" action="{{ url('/job/add') }}"
                      method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                    <div>
                        <div class="form-group">
                            <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="cid">请选择客户:</label>

                            <div class="col-xs-12 col-sm-9">
                                <select name="customer_id" id="customer_id" class="col-xs-12 col-sm-4">
                                    <option></option>
                                    @foreach(Auth::user()->customers as $customer)
                                        @if (!empty(old('customer_id')))
                                            <option value="{{ $customer->id }}"
                                                    @if (old('customer_id') == $customer->id) selected="selected" @endif>{{ $customer->name }}</option>
                                        @else
                                            <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <div class="red">
                                    {{ $errors->first('cid') }}</div>
                            </div>
                        </div>

                        <div class="form-group hide">
                            <label class="control-label col-xs-12 col-sm-3 no-padding-right"
                                   for="department_id">招聘部门:</label>

                            <div class="col-xs-12 col-sm-9">
                                <select type="text" id="department_id" name="department_id" class="col-xs-12 col-sm-4">
                                    <option></option>
                                </select>
                                {{ $errors->first('department_id') }}</div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="name">职位名称:</label>

                        <div class="col-xs-12 col-sm-9">
                            <div class="clearfix">
                                <input type="text" id="name" name="name" value="{{ old('name') }}"
                                       class="col-xs-12 col-sm-5">
                                <div class="red">
                                    {{ $errors->first('name') }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="comment">任职要求(JD):</label>

                        <div class="col-xs-12 col-sm-9">
                            <div class="clearfix">
                                <textarea name="requirement" id="requirement" value="{{ old('requirement') }}"
                                          cols="100" rows="10"></textarea>
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
                                @foreach(config('lieplus.workyears') as $k => $value)
                                    <option value="{{ $k }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="comment">性别要求:</label>

                        <div class="col-xs-12 col-sm-9">
                            <select name="gender" id="gender" class="col-xs-12 col-sm-4">
                                <option value="0"></option>
                                @foreach(config('lieplus.gender') as $k => $value)
                                    <option value="{{ $k }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="comment">专业要求:</label>

                        <div class="col-xs-12 col-sm-9">
                            <select name="majors" id="majors" class="col-xs-12 col-sm-4">
                                <option value="0"></option>
                                @foreach(config('lieplus.majors') as $key => $value)
                                    <option value="{{ $k }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="comment">学历要求:</label>

                        <div class="col-xs-12 col-sm-9">
                            <select name="degree" id="degree" class="col-xs-12 col-sm-4">
                                <option value="0"></option>
                                @foreach(config('lieplus.degree') as $key => $value)
                                    <option value="{{ $k }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="comment">是否统招全日制:</label>

                        <div class="col-xs-12 col-sm-9">
                            <label>
                                <input id="unified" name="unified" type="checkbox" class="ace ace-switch ace-switch-4"
                                       value="1">
                                <span class="lbl middle"
                                      data-lbl="是&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;否"></span>
                            </label>
                        </div>
                    </div>
                    <div class="hr hr-dotted"></div>
                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="comment">薪酬结构:</label>

                        <div class="col-xs-12 col-sm-9">
                            <div class="clearfix">
                                <textarea name="salary" id="salary" cols="100" rows="10"
                                          value="{{ old('salary') }}"></textarea>
                            </div>
                            <div class="red">{{ $errors->first('salary') }}</div>

                        </div>
                    </div>

                    <div class="form-group text-center">
                        <button class="btn btn-primary" type="submit">
                            <i class="ace-icon fa fa-plus bigger-125"></i>
                            新建
                        </button>
                        <button class="btn" type="reset">
                            <i class="ace-icon fa fa-undo bigger-125"></i>
                            重置
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @else
        Access Denied!
    @endrole
@endsection

@section('js')
    @role('admin|manager|customer')
    <script type="text/javascript">
        jQuery(function ($) {
            var departments = [];
            $.each({!! json_encode(config('lieplus.departments')) !!}, function (key, value) {
                departments[key] = [];
                $.each(value, function (k, v) {
                    departments[key].push({id: k, text: v});
                });
            });

            $('#customer_id').select2({
                placeholder: '请选择客户',
                width: 240
            });


            $(document).ready(function () {
                $('#customer_id').change(function () {
                    if ($(this).val() != '') {
                        $('#department_id').parents('.form-group').removeClass('hide').find("option").remove();
                        $('#department_id').select2({
                            placeholder: '请选择招聘部门',
                            width: 240,
                            ajax: {
                                url: "{{ route('get.departments', 88888) }}".replace('88888', $('#customer_id').val()),
                                dataType: 'json',
                                processResults: function (data, params) {
                                    var departments = [];
                                    $.each(data, function (k, v) {
                                        departments.push({id: k, text: v});
                                    });
                                    return {results: departments};
                                },
                                cache: true
                            },
                        });
                        $('#department_id').val({{ old('department_id') }});
                    }
                });

            });

            $('#cid').on('select2:select', function (evt) {
                //alert($('#department').parents('.form-group').html());return;
                $('#did').parents('.form-group').removeClass('hide').find("option").remove();
                //$('#department').find("option").remove();
                $('#did').select2({
                    data: departments[$('#cid').val()],
                    width: 140
                });
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
    @endrole
@endsection
