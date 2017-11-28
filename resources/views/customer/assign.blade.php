@role('admin|manager')
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">
    ×
    </button>
    <h4 class="modal-title">分配客户顾问</h4>
</div>
<div class="modal-body">
    <form  method="POST" action="{{ route('customer.assign') }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="cid" id="cid" value="">
        <div class="form-group">
            <label class="control-label col-xs-12 col-sm-2 no-padding-right">客户顾问:</label>
            <div class="col-xs-6 col-sm-6">
                <div class="clearfix">
                    <select name="uid" id="uid">
                    <option></option>
                    @isset ($users)
                    <option></option>
                    @foreach ($users as $user)
                    <option value="{{ $user->id }}" @if ( $user->id == $aid )
                         disabled="disabled"
                        @endif>{{ $user->name }}</option>
                    @endforeach
                    @endisset
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group text-center">
            <button type="submit" class="btn btn-success btn-xs">
                <i class="ace-icon fa fa-plus bigger-125"></i> 分配
            </button>
        </div>
    </form>
</div>
@endrole