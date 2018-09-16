<link rel="stylesheet" href="{{ asset('static/css/bootstrap-datepicker3.min.css') }}" />
<link rel="stylesheet" href="{{ asset('static/css/bootstrap-datetimepicker.min.css') }}" />
<form name="alert_form" action="/alert/save" method="post">
<input type="hidden" name="_token" value="{{ csrf_token() }}"/>
<table>
    <thead>
        <tr>
            <input type="hidden" name="id" value="{{ old('alert')['id'] ? old('alert')['id'] : $alert->id }}" />
            <td class="col-sm-2 text-right">时刻</td>
            <td class="col-sm-4">
                <div class="form-group">
                <div class='input-group date' id='datetimepicker'>
                    <input type="datetime" name="alert_at" class="form-control" value='{{ old('alert')['alert_at'] ? old('alert')['alert_at'] : $alert->alert_at }}' required/>
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
            </td>
        </tr>
        <tr>
            <td class="col-sm-2 text-right">类别</td>
            <td class="col-sm-4">
                <select name="type" id="type">
                    @foreach(config('lieplus.alerttype') as $value)
                    <option value="{{ $value['id'] }}" @if($value['id'] == 0) selected="selected" @endif>{{ $value['text'] }}</option>
                    @endforeach
                </select>
            </td>
        </tr>
        <tr>
            <input type="hidden" name="rid" value="{{ old('resume')['id'] ? old('resume')['id'] : $resume->id }}" />
            <td class="col-sm-2 text-right">对象</td>
            <td class="col-sm-4">{{ old('alert')['name'] ? old('alert')['name'] : $resume->name }}</td>
        </tr>
        <tr>
            <td class="col-sm-2 text-right">批注</td>
            <td class="col-sm-6">
                <textarea name="description" id="description" cols="70" rows="5" required>{{ old('alert')['description'] ? old('alert')['description'] : $alert->description }}</textarea>
            </td>
        </tr>
        <tr>
            <input type="hidden" name="operator" value="0" />
            <td class="col-sm-2 text-right">执行者</td>
            <td class="col-sm-4">
                <input id="operatorName" type="text" value="{{ old('alert')['operator'] ? old('alert')['operator'] : App\User::find($alert->operator)->name }}" required/>
            </td>
        </tr>
        <tr>
            <td class="col-sm-2 text-right">创建者</td>
            <td class="col-sm-4">{{ old('alert')['creater'] ? old('alert')['creater'] : Auth::user()->name }}</td>
        </tr>
        <tr>
        <td colspan="3">
        <div class="space-8"></div>
        <center>
        <button class="btn btn-primary" type="submit">
            <i class="ace-icon fa fa-floppy-o align-top bigger-125"></i>
            保存
        </button>
        <button class="btn" type="reset">
            <i class="ace-icon fa fa-ban align-top bigger-125"></i>
            取消
        </button>
        </center>
        </td>
        </tr>
    </thead>
</table>
</form>
<script src="{{ asset('static/js/moment.min.js') }}"></script>
<script src="{{ asset('static/localisation/moment-zh-cn.js') }}"></script>
<script src="{{ asset('static/js/bootstrap-datetimepicker.min.js') }}"></script>
<script src="{{ asset('static/js/jquery.validate.min.js') }}"></script>
<script type="text/javascript">
    $(function () {
        $('#datetimepicker').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            stepping: 15,
            locale: 'zh-cn',
            widgetPositioning: {
                horizontal: 'left',
                vertical: 'bottom'
            },
            sideBySide: true,
            ignoreReadonly: true,
        });

        $('#type').select2({
            width: 140
        })
    });
            //$("#alert_form").validate();

</script>