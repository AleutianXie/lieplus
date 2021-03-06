@extends('Lieplus::layouts.cici')

@section('title', '编辑简历')

@section('content')
    @if (Auth::user()->hasRole('admin') || $resume->created_by == Auth::id())
    {{-- 编辑简历表单--开始 --}}
    <div class="container-fluid">
        <form class="form-horizontal" id="validation-form" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
            <div class="form-group">
                <label class="control-label col-xs-6 col-sm-1 no-padding-right" for="name">姓名:</label>

                <div class="col-xs-6 col-sm-2">
                    <div class="clearfix">
                        <input type="text" name="name" id="name" value="{{ old('name') ?? $resume->name }}" required/>
                    </div>
                </div>

                <label class="control-label col-xs-6 col-sm-3 no-padding-right">性别:</label>

                <div class="col-xs-6 col-sm-2">
                    @foreach (config('lieplus.gender') as $key => $value)
                        <label class="control-label line-height-1 blue">
                            <input name="gender" type="radio" class="ace" value="{{ $key }}"
                                   @if (old('gender') ?? $resume->gender == $key) checked @endif required/>
                            <span class="lbl"> {{ $value }}</span>
                            &nbsp;
                        </label>
                    @endforeach
                    <span class="red">
          {{ $errors->first('gender') }}
        </span>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-xs-6 col-sm-1 no-padding-right" for="phone">手机:</label>
                <div class="col-xs-6 col-sm-2">
                    <div class="input-group">
        <span class="input-group-addon">
          <i class="ace-icon fa fa-phone"></i>
        </span>

                        <input type="tel" id="mobile" name="mobile" value="{{ old('mobile') ?? $resume->mobile }}"
                               required pattern="1(3|4|5|7|8)[0-9]{9}"/>
                    </div>
                    <span class="red">
        {{ $errors->first('mobile') }}
      </span>
                </div>

                <label class="control-label col-xs-6 col-sm-3 no-padding-right" for="email">邮箱:</label>
                <div class="col-xs-6 col-sm-3">
                    <div class="input-group">
        <span class="input-group-addon">
          <i class="ace-icon fa fa-envelope"></i>
        </span>

              <input type="email" name="email" id="email" value="{{ old('email') ?? $resume->email }}" style="width: 100%" required/>
                    </div>
                    <span class="red">
        {{ $errors->first('email') }}
      </span>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-xs-6 col-sm-1 no-padding-right" for="degree">学历:</label>
                <div class="col-xs-6 col-sm-2">
                    <div class="clearfix">
                        <select name="degree" id="degree">
                            @foreach (config('lieplus.degree') as $key => $value)
                                <option value="{{ $key }}"
                                        @if (old('degree') ?? $resume->degree == $key) selected @endif>{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <label class="control-label col-xs-6 col-sm-3 no-padding-right" for="state">城市:</label>
                <div class="col-xs-6 col-sm-6">
                    <select id="province" name="province" required">
                        <option></option>
                    @foreach ($provinces as $key => $province)
                        <option value="{{ $key }}" @if($key == $resume->province->adcode) selected @endif>{{ $province }}</option>
                    @endforeach
                    </select>
                    <select id="city" name="city" required data-value="{{ $resume->city }}">
                        <option></option>
                        @foreach ($cities as $key => $city)
                            <option value="{{ $key }}" @if($key == $resume->city->adcode) selected @endif>{{ $city }}</option>
                        @endforeach
                    </select>
                    <select id="county" name="county" required data-value="{{ $resume->county }}">
                        <option></option>
                        @foreach ($counties as $key => $county)
                            <option value="{{ $key }}" @if($key == $resume->county->adcode) selected @endif>{{ $county }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-xs-6 col-sm-1 no-padding-right" for="birthdate">生日:</label>
                <div class="col-xs-6 col-sm-3">
                    <div class="input-group">
        <span class="input-group-addon">
          <i class="ace-icon fa fa-calendar"></i>
        </span>

                        <input type="date" name="birthdate" id="birthdate"
                               value="{{ old('birthdate') ?? $resume->birthdate }}" required
                               max="{{ date('Y-m-d', time()) }}"/>
                        <span class="red">
            {{ $errors->first('birthdate') }}
        </span>
                    </div>
                </div>

                <label class="control-label col-xs-12 col-sm-2 no-padding-right" for="start_work_date">开始工作:</label>
                <div class="col-xs-6 col-sm-2">
                    <div class="input-group">
        <span class="input-group-addon">
          <i class="ace-icon fa fa-calendar"></i>
        </span>

                        <input type="date" name="start_work_date" id="start_work_date"
                               value="{{ old('start_work_date') ?? $resume->start_work_date }}"
                               max="{{ date('Y-m-d', time()) }}" min="{{ date('Y-m-d', strtotime('-20 years')) }}"
                               required/>
                        <span class="red">
          {{ $errors->first('start_work_date') }}
        </span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-xs-6 col-sm-1 no-padding-right" for="service_status">当前状态:</label>
                <div class="col-xs-6 col-sm-2">
                    <div class="clearfix">
                        <select name="service_status" id="service_status">
                            @foreach (config('lieplus.service.status') as $key => $value)
                                <option value="{{ $key }}"
                                        @if($resume->stervice_status == $key) checked @endif>{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <label class="control-label col-xs-6 col-sm-3 no-padding-right" for="industry">当前行业:</label>
                <div class="col-xs-6 col-sm-2">
                    <div class="clearfix">
                        <input type="text" name="industry" id="industry"
                               value="{{ old('industry') ?? $resume->industry }}"/>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-xs-6 col-sm-1 no-padding-right" for="position">当前职位:</label>
                <div class="col-xs-6 col-sm-2">
                    <div class="clearfix">
                        <input type="text" name="position" id="position"
                               value="{{ old('position') ?? $resume->position }}"/>
                    </div>
                </div>

                <label class="control-label col-xs-6 col-sm-3 no-padding-right" for="salary">期望薪资:</label>
                <div class="col-xs-6 col-sm-2">
                    <div class="clearfix">
                        <select name="salary" id="salary" class="col-xs-12 col-sm-4">
                            @foreach (config('lieplus.salary') as $key => $value)
                                <option value="{{ $key }}"
                                        @if (old('salary') ?? $resume->salary == $key) checked @endif>{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="hr hr-dotted"></div>

            <div class="form-group">
                <label class="control-label col-xs-6 col-sm-1 no-padding-right" for="others"><b>其它:</b></label>
                <div class="col-xs-12 col-sm-10">
                    <textarea name="others" id="others" style="min-height: 600px;">{!! old('others') ?? $resume->others !!}</textarea>
                </div>
            </div>

            <div class="form-group text-center">
                <button class="btn btn-primary" type="submit">
                    <i class="ace-icon fa fa-edit bigger-125"></i>
                    修改
                </button>
                <button class="btn" type="reset">
                    <i class="ace-icon fa fa-undo bigger-125"></i>
                    重置
                </button>
            </div>

        </form>
    </div>
    {{-- 创建简历表单--结束 --}}
    @else
        Access Deny!
    @endif
@endsection

@section('css')
    @if (Auth::user()->hasRole('admin') || $resume->created_by == Auth::id())
    <script src='/tinymce/tinymce.min.js'></script>
    <script>
        tinymce.init({
            selector: '#others',
            plugins: ['paste', 'link'],
            language_url: '/tinymce/langs/zh_CN.js'
        });
    </script>
    @endif
@stop

@section('js')
    @if (Auth::user()->hasRole('admin') || $resume->created_by == Auth::id())
    <script type="text/javascript">
        $('#degree').select2({
            minimumResultsForSearch: Infinity,
            width: 140
        });

        // $('#birthdate').datepicker({
        //     format: 'yyyy-mm-dd',
        // });

        // $('#startworkdate').datepicker({
        //     format: 'yyyy-mm-dd',
        // });

        $('#province').select2({
            placeholder: '请选择省',
            width: 140,
            ajax: {
                url: "{{ url('/provinces') }}",
                dataType: 'json',
                processResults: function (data, params) {
                    var provinces = [];
                    $.each(data, function (k, v) {
                        provinces.push({id: k, text: v});
                    });
                    return {results: provinces};
                },
                cache: true
            },
        });

        $('#city').select2({
            placeholder: '请选择市',
            width: 140,
            ajax: {
                url: function () {
                    return '/province/' + $('#province').val() + '/cities';
                },
                dataType: 'json',
                processResults: function (data, params) {
                    var cities = [];
                    $.each(data, function (k, v) {
                        cities.push({id: k, text: v});
                    });
                    return {results: cities};
                },
                cache: true
            },
        });

        $('#county').select2({
            placeholder: '请选择县',
            width: 140,
            ajax: {
                url: function () {
                    return '/city/' + $('#city').val() + '/counties';
                },
                dataType: 'json',
                processResults: function (data, params) {
                    var counties = [];
                    $.each(data, function (k, v) {
                        counties.push({id: k, text: v});
                    });
                    return {results: counties};
                },
                cache: true
            },
        });

        $('#province').on('select2:select', function (evt) {
            $('#city').find("option").remove();
            $('#county').find("option").remove();
        });

        $('#city').on('select2:select', function (evt) {
            $('#county').find("option").remove();
        });

        $('#service_status').select2({
            minimumResultsForSearch: Infinity,
            width: 140
        });

        $('#salary').select2({
            minimumResultsForSearch: Infinity,
            width: 140
        });
    </script>
    @endif
@endsection
