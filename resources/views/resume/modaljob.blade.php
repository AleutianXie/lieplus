@role('admin|manager|recruiter')
{{-- 加入简历库 --}}
<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
        ×
        </button>
        <h4 class="modal-title">加入职位流水线</h4>
    </div>
    <div class="modal-body">
        <form  method="POST" action="{{ route('resume.addjob') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="rid" value="{{ $resume->id }}">
            <div class="form-group">
                <label class="control-label col-xs-12 col-sm-2 no-padding-right" for="jid">职位简历库:</label>
                <div class="col-xs-6 col-sm-6">
                    <div class="clearfix">
                        <select name="jid" id="jid">
                        <option></option>
                        @isset ($lines)
                        @foreach ($lines as $line)
                        <option value="{{ $line->job->id }}" @if ( 1 == $line->isAssigned )
                         disabled="disabled"
                        @endif >{{ $line->job->sn }}({{ $line->job->name }})</option>
                        @endforeach
                        @endisset
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group text-center">
                <button type="submit" class="btn btn-success btn-xs">
                    <i class="ace-icon fa fa-plus bigger-125"></i> 加入
                </button>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('#jid').select2({
            placeholder: "请选择职位流水线",
            allowClear: true,
            width: 300
        });
    });
</script>
@endrole
