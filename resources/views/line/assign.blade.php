@role('admin|manager')
<form class="form-horizontal" id="validation-form" method="post" action="/line/assign/{{ $id }}">
    <div class="form-group text-center">
        <input type="hidden" name="lid" id="lid" value="{{ $id }}" />
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <select name="uid" id="uid">
            @foreach ($users as $user)
            <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group text-center">
        <button class="btn btn-primary" type="submit">
        <i class="ace-icon fa fa-plus-circle"></i>
        提交
        </button>
    </div>
</form>
<script type="text/javascript">
    $('#uid').select2({
        minimumResultsForSearch: -1,
        width: 140
    });
</script>
@endrole