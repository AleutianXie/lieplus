@role('admin|manager|customer')
{{-- 分配招聘 --}}
<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
        ×
        </button>
        <h4 class="modal-title">分配招聘顾问</h4>
    </div>
    <div class="modal-body">
        <form  method="POST" action="{{ route('line.assign', $line->id) }}">
            <div class="form-group text-center">
                <input type="hidden" name="lid" id="lid" value="{{ $line->id }}" />
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label class="control-label col-xs-12 col-sm-2 no-padding-right" for="uid">招聘顾问:</label>
                    <div class="col-xs-6 col-sm-6">
                        <div class="clearfix">
                            <select name="uid" id="uid">
                            <option></option>
                            @isset ($users)
                            @foreach ($users as $user)
                            <option value="{{ $user->id }}" @if ( isset($aids) && in_array($user->id, $aids) )
                             disabled="disabled"
                            @endif >{{ $user->name }}</option>
                            @endforeach
                            @endisset
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group text-center">
                <button class="btn btn-primary btn-xs" type="submit">
                <i class="ace-icon fa fa-plus-circle bigger-125"></i>
                分配
                </button>
            </div>
        </form>
    </div>
</div>
@endrole