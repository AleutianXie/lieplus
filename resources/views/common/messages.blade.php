{{-- 成功提示 --}}
@if (Session::has('success'))
<div class="alert alert-block alert-success">
    <i class="ace-icon fa fa-check green">
    </i>
    {{ Session::get('success') }}
</div>
@endif
{{-- 失败提示 --}}
@if (Session::has('error'))
<div class="alert alert-block alert-danger">
    <i class="ace-icon fa fa-check green">
    </i>
    {{ Session::get('error') }}
</div>
@endif
{{-- 校验提示 --}}
@if (count($errors))
<div class="alert alert-block alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>
            <i class="ace-icon fa fa-close red">
            </i>
            {{ $error }}
        </li>
        @endforeach
    </ul>
</div>
@endif
