@extends('Lieplus::layouts.cici')

@section('title', '用户中心')

@section('content')
    @include('Lieplus::common.messages')
    <div class="tabbable">
        <ul class="nav nav-tabs padding-18 tab-size-bigger" id="myTab">
            <li @if('index' == $tab)class="active"@endif>
                <a data-toggle="tab" href="#baseinfo" aria-expanded="false">
                    <i class="blue ace-icon fa fa-user bigger-120"></i>
                    基础信息
                </a>
            </li>

            <li @if('password' == $tab)class="active"@endif>
                <a data-toggle="tab" href="#password" aria-expanded="false">
                    <i class="green ace-icon fa fa-key bigger-120"></i>
                    密码
                </a>
            </li>
            @role('admin')
            <li @if('setting' == $tab)class="active"@endif>
                <a data-toggle="tab" href="#settings" aria-expanded="false">
                    <i class="purple ace-icon fa fa-cog bigger-120"></i>
                    设置
                </a>
            </li>
            @endrole
        </ul>

        <div class="tab-content no-border padding-24">
            {{-- 基础信息--开始 --}}
            @if (Auth::user()->hasRole('admin') || Auth::id() == $user->id)
                <div id="baseinfo" @if('index' == $tab)class="tab-pane fade in active"
                     @else class="tab-pane fade" @endif >
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
                            <img id="avatar" class="editable img-responsive editable-click editable-empty"
                                 alt="{{ $user->name }}"
                                 src="{{ empty($user->profile->avatar) ? asset('/images/avatars/profile-pic.jpg') : $user->profile->avatar }}"
                                 style="display: block;">
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
                                            <li class="dropdown-header"> 更改状态</li>

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
                                    <div class="profile-info-name"> 姓名</div>
                                    <div class="profile-info-value">
                                        <span class="editable editable-click" id="name"
                                              style="display: inline;">{{ $user->name }}</span>
                                    </div>
                                </div>
                                <div class="profile-info-row">
                                    <div class="profile-info-name"> 员工号</div>

                                    <div class="profile-info-value">
                                <span class="editable editable-click" id="number">
                                    @isset ($user->profile->number)
                                        {{ $user->profile->number }}
                                    @endisset
                                    </span>
                                    </div>
                                </div>
                                <div class="profile-info-row">
                                    <div class="profile-info-name"> 性别</div>
                                    <div class="profile-info-value">
                                        <span class="editable editable-click" id="gender"
                                              style="display: inline;">{{ isset($user->profile) ? config('lieplus.gender.'.$user->profile->gender) : '' }}</span>
                                    </div>
                                </div>
                                <div class="profile-info-row">
                                    <div class="profile-info-name"> 手机</div>
                                    <div class="profile-info-value">
                                <span class="editable editable-click" id="mobile" style="display: inline;">
                                    @isset ($user->profile->mobile)
                                        {{ $user->profile->mobile }}
                                    @endisset</span>
                                    </div>
                                </div>
                                <div class="profile-info-row">
                                    <div class="profile-info-name"> 邮箱</div>
                                    <div class="profile-info-value">
                                        <span class="editable editable-click" id="email"
                                              style="display: inline;">{{ $user->email }}</span>
                                    </div>
                                </div>

                                <div class="profile-info-row">
                                    <div class="profile-info-name"> 出生日期</div>

                                    <div class="profile-info-value">
                                <span class="editable editable-click" id="birthdate">
                                    @isset ($user->profile->birthdate)
                                        {{ $user->profile->birthdate }}
                                    @endisset
                                    </span>
                                    </div>
                                </div>

                                <div class="profile-info-row">
                                    <div class="profile-info-name"> 部门</div>

                                    <div class="profile-info-value">
                                <span class="editable editable-click" id="did">
                                    @isset ($user->profile->did)
                                        {{ $user->profile->department->name }}
                                    @endisset
                                    </span>
                                    </div>
                                </div>
                            </div>

                            <div class="space-8"></div>
                            <div class="panel panel-default profile-user-info profile-user-info-striped">
                                <div class="panel-heading">角色列表</div>

                                <div class="panel-body">
                                    <table class="table table-hover table-striped">
                                        <tbody>
                                        @foreach($user->getRoleNames() as $role_name)
                                            <tr>
                                                <td>{{ __('lieplus.roles.'.$role_name) }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    @role('admin')
                                    <a href="#" class="btn btn-link" onclick="assign({{ $user->id }});">
                                        <i class="ace-icon fa fa-plus-circle bigger-120 green"></i>&nbsp;
                                        分配
                                    </a>
                                    @endrole
                                </div>

                                <div id="role-dialog" class="row hide">
                                    <form class="form-horizontal" id="validation-form" method="post"
                                          action="/admin/addrole">
                                        <div class="form-group text-center">
                                            <input type="hidden" name="user_id" id="user_id" value="{{ $user->id }}"/>
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <select name="role" id="role">
                                                @foreach ($roles as $role)
                                                    @if ('admin' != $role->name && !in_array($role->name, $user->getRoleNames()->toArray()))
                                                        <option
                                                            value="{{ $role->name }}">{{ __('lieplus.roles.'.$role->name) }}</option>
                                                    @endif
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            {{-- 基础信息--结束 --}}

            {{-- 密码--开始 --}}
            <div id="password" @if('password' == $tab)class="tab-pane fade in active" @else class="tab-pane fade"@endif>
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
            @role('admin')
            <div id="settings" class="tab-pane fade">
                <div class="row">
                    <h4 class="purple">
                        <i class="green ace-icon fa fa-key bigger-110"></i>
                        设置
                    </h4>
                </div>
                <div id="accordion" class="accordion-style2 col-xs-12 col-sm-6">
                    <div class="group">
                        <h3 class="accordion-header">部门</h3>
                        <div>
                            <table class="table table-striped table-bordered table-hover">
                                <thead class="thin-border-bottom">
                                <tr>
                                    <th>
                                        编码
                                    </th>

                                    <th>
                                        名称
                                    </th>
                                    <th class="hidden-480">描述</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach ($departments as $department)
                                    <tr>
                                        <td>{{ $department->number }}</td>
                                        <td>{{ $department->name }}</td>
                                        <td>
                                            <span
                                                class="label label-info arrowed-in arrowed-in-right">{{ $department->description }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <form class="form-horizontal" id="userdepartment-form" name="userdepartment-form"
                                  action="{{ url('/user/department/add') }}" method="POST">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                                <div class="form-group">
                                    <label class="control-label col-xs-6 col-sm-2 no-padding-right"
                                           for="number">部门编码:</label>

                                    <div class="col-xs-12 col-sm-10">
                                        <div class="clearfix">
                                            <input type="text" id="number" name="number" value="{{ old('number') }}"
                                                   class="col-xs-12 col-sm-5" required>
                                            <div class="red">
                                                {{ $errors->first('number') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-xs-6 col-sm-2 no-padding-right"
                                           for="dname">部门名称:</label>

                                    <div class="col-xs-12 col-sm-10">
                                        <div class="clearfix">
                                            <input type="text" id="dname" name="dname" value="{{ old('dname') }}"
                                                   class="col-xs-12 col-sm-5" required>
                                            <div class="red">
                                                {{ $errors->first('dname') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-xs-6 col-sm-2 no-padding-right" for="description">部门描述:</label>

                                    <div class="col-xs-12 col-sm-10">
                                        <div class="clearfix">
                                            <textarea name="description" id="description" cols="40" rows="5"
                                                      value="{{ old('description') }}"></textarea>
                                            <div class="red">
                                                {{ $errors->first('description') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group center">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="ace-icon fa fa-plus"></i>
                                        新建
                                    </button>
                                    <button class="btn" type="reset">
                                        <i class="ace-icon fa fa-undo"></i>
                                        重置
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="group">
                        <h3 class="accordion-header">角色</h3>
                        <div>
                            <table class="table table-striped table-bordered table-hover">
                                <thead class="thin-border-bottom">
                                <tr>
                                    <th>
                                        编号
                                    </th>

                                    <th>
                                        名称
                                    </th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach ($roles as $role)
                                    <tr>
                                        <td>{{ $role->id }}</td>
                                        <td>{{ __('lieplus.roles.'.$role->name) }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{--                     <form class="form-horizontal" id="role-form" name="role-form" action="{{ url('/role/add') }}" method="POST">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                                                    <div class="form-group">
                                                        <label class="control-label col-xs-6 col-sm-2 no-padding-right" for="rname">角色名称:</label>

                                                        <div class="col-xs-6 col-sm-10">
                                                            <div class="clearfix">
                                                                <input type="text" id="rname" name="rname" value="{{ old('rname') }}" class="col-xs-12 col-sm-5" required>
                                                                <div class="red">
                                                                    {{ $errors->first('rname') }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group center">
                                                        <button class="btn btn-primary" type="submit">
                                                            <i class="ace-icon fa fa-plus"></i>
                                                            新建
                                                        </button>
                                                        <button class="btn" type="reset">
                                                            <i class="ace-icon fa fa-undo"></i>
                                                            重置
                                                        </button>
                                                    </div>
                                                </form> --}}
                        </div>
                    </div>

                    <div class="group">
                        <h3 class="accordion-header">权限</h3>
                        <div class="widget-body">
                            <div class="widget-main padding-8">
                                <ul id="tree1"></ul>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- update phase 2 --}}
                <div class="col-xs-12 col-sm-6">
                    <div class="widget-box">
                        <div class="widget-header widget-header-flat widget-header-small">
                            <h5 class="widget-title">
                                <i class="ace-icon fa fa-signal"></i>
                                Traffic Sources
                            </h5>

                            <div class="widget-toolbar no-border">
                                <div class="inline dropdown-hover">
                                    <button class="btn btn-minier btn-primary">
                                        This Week
                                        <i class="ace-icon fa fa-angle-down icon-on-right bigger-110"></i>
                                    </button>

                                    <ul class="dropdown-menu dropdown-menu-right dropdown-125 dropdown-lighter dropdown-close dropdown-caret">
                                        <li class="active">
                                            <a href="javascript:void(-1)" class="blue">
                                                <i class="ace-icon fa fa-caret-right bigger-110">&nbsp;</i>
                                                This Week
                                            </a>
                                        </li>

                                        <li>
                                            <a href="javascript:void(-1)">
                                                <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                                                Last Week
                                            </a>
                                        </li>

                                        <li>
                                            <a href="javascript:void(-1)">
                                                <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                                                This Month
                                            </a>
                                        </li>

                                        <li>
                                            <a href="javascript:void(-1)">
                                                <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                                                Last Month
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="widget-body">
                            <div class="widget-main">
                                <!-- #section:plugins/charts.flotchart -->
                                <div id="piechart-placeholder" style="width:90%; height:150px"></div>

                                <!-- /section:plugins/charts.flotchart -->
                                <div class="hr hr8 hr-double"></div>

                                <div class="clearfix">
                                    <!-- #section:custom/extra.grid -->
                                    <div class="grid3">
                                                            <span class="grey">
                                                                <i class="ace-icon fa fa-facebook-square fa-2x blue"></i>
                                                                &nbsp; likes
                                                            </span>
                                        <h4 class="bigger pull-right">1,255</h4>
                                    </div>

                                    <div class="grid3">
                                                            <span class="grey">
                                                                <i class="ace-icon fa fa-twitter-square fa-2x purple"></i>
                                                                &nbsp; tweets
                                                            </span>
                                        <h4 class="bigger pull-right">941</h4>
                                    </div>

                                    <div class="grid3">
                                                            <span class="grey">
                                                                <i class="ace-icon fa fa-pinterest-square fa-2x red"></i>
                                                                &nbsp; pins
                                                            </span>
                                        <h4 class="bigger pull-right">1,050</h4>
                                    </div>

                                    <!-- /section:custom/extra.grid -->
                                </div>
                            </div><!-- /.widget-main -->
                        </div><!-- /.widget-body -->
                    </div><!-- /.widget-box -->
                </div><!-- /.col -->
            </div>
            @endrole
            {{-- 设置--结束 --}}
        </div>
    </div>

@endsection


@section('js')
    <script type="text/javascript">
        //editables on first profile page
        $.fn.editable.defaults.mode = 'inline';
        //editables
        //text editable
        $('#name').editable({
            @if (!Auth::user()->hasRole('admin') && Auth::id() != $user->id)
            disabled: true,
            @endif
            type: 'text',
            url: '/user/edit',
            params: {'_token': '{{ csrf_token() }}'},
            pk: {{ $user->id }},
            error: function (response) {
                return response.responseJSON.errors.name[0];
            }
        });

        $('#email').editable({
            @if (!Auth::user()->hasRole('admin') && Auth::id() != $user->id)
            disabled: true,
            @endif
            type: 'text',
            url: '/user/edit',
            params: {'_token': '{{ csrf_token() }}'},
            pk: `{{ $user->id }}`,
            error: function (response) {
                return response.responseJSON.errors.email[0];
            }
        });

        $('#number').editable({
            @if (!Auth::user()->hasRole('admin') && Auth::id() != $user->id)
            disabled: true,
            @endif
            type: 'text',
            url: '/user/edit',
            params: {'_token': '{{ csrf_token() }}'},
            pk: `{{ $user->id }}`,
            error: function (response) {
                return response.responseJSON.errors.number[0];
            }
        });

        var genders = [];
        @foreach(config('lieplus.gender') as $id => $text)
        {
            genders.push({'id': `{{ $id }}`, 'text': `{{ $text }}`});
        }
        @endforeach
        $('#gender').editable({
            @if (!Auth::user()->hasRole('admin') && Auth::id() != $user->id)
            disabled: true,
            @endif
            type: 'select2',
            url: '/user/edit',
            params: {'_token': '{{ csrf_token() }}'},
            pk: `{{ $user->id }}`,
            //onblur:'ignore',
            source: genders,
            select2: {
                'value': `{{ $user->profile->gender }}`,
                'width': 140,
            }
        });
        $('#mobile').editable({
            @if (Auth::user()->hasRole('admin') || Auth::id() == $user->id)
                @else
            disabled: true,
            @endif
            type: 'text',
            url: '/user/edit',
            params: {'_token': '{{ csrf_token() }}'},
            pk: {{ $user->id }},
            error: function (response) {
                return response.responseJSON.errors.mobile[0];
            }
        });
        $('#birthdate').editable({
            @if (Auth::user()->hasRole('admin') || Auth::id() == $user->id)
                @else
            disabled: true,
            @endif
            type: 'text',
            url: '/user/edit',
            params: {'_token': '{{ csrf_token() }}'},
            pk: {{ $user->id }},
            error: function (response) {
                return response.responseJSON.errors.birthdate[0];
            }
        });

        // var provinces = [{"id":1, "text":"name"},{"id":2, "text": "name2"}];

        $('#did').editable({
            @if (Auth::user()->hasRole('admin') || Auth::id() == $user->id)
                @else
            disabled: true,
            @endif
            type: 'select2',
            url: '/user/edit',
            params: {'_token': '{{ csrf_token() }}'},
            pk: {{ $user->id }},
            source: {!! json_encode($departmentList) !!},
            select2: {
                minimumResultsForSearch: Infinity,
                'width': 180,
            },
            error: function (response) {
                return response.responseJSON.errors.pid[0];
            }
        });

        function assign(id) {
            $("#role-dialog").removeClass('hide').dialog({
                modal: true,
                title: "分配角色",
                width: '25%',
                resizable: false
            });
        }

        $('#role').select2({
            minimumResultsForSearch: -1,
            width: 140
        });
    </script>

    <script type="text/javascript">
        jQuery(function ($) {




            //jquery accordion
            $("#accordion").accordion({
                collapsible: true,
                heightStyle: "content",
                animate: 250,
                header: ".accordion-header"
            }).sortable({
                axis: "y",
                handle: ".accordion-header",
                stop: function (event, ui) {
                    // IE doesn't register the blur when sorting
                    // so trigger focusout handlers to remove .ui-state-focus
                    ui.item.children(".accordion-header").triggerHandler("focusout");
                }
            });


            var sampleData = initiateDemoData();//see below


            $('#tree1').ace_tree({
                dataSource: sampleData['dataSource1'],
                multiSelect: true,
                cacheItems: true,
                'open-icon': 'ace-icon tree-minus',
                'close-icon': 'ace-icon tree-plus',
                'itemSelect': @role('admin')'true'@else'false'@endrole,
                    'folderSelect'
        :
            false,
                'selected-icon'
        :
            'ace-icon fa fa-check',
                'unselected-icon'
        :
            'ace-icon fa fa-times',
                loadingHTML
        :
            '<div class="tree-loading"><i class="ace-icon fa fa-refresh fa-spin blue"></i></div>'
        })
            ;

            function initiateDemoData() {
                var tree_data = {
                    //attr = {
                    //         'classes': 'required-item red-text',
                    //         'data-parent': parentId,
                    //         'guid': guid,
                    //         'id': guid
                    //     }
                    @foreach ($roles as $role)
                        @if ($role->name != 'admin')
                    '{{ $role->name }}': {
                        text: '{{ __('lieplus.roles.'.$role->name) }}',
                        type: 'folder',
                        @if (!is_null($role->permission) && count($role->permission))
                        additionalParameters: {
                            children: {
                                @foreach ($role->permission as $permission)
                                '{{ $permission->id }}': {
                                    text: '{{ $permission->description}}',
                                    type: 'item',
                                    @if ($permission->enabled)
                                    attr: {
                                        class: 'tree-selected',
                                        'data-icon': 'ace-icon fa fa-check',
                                    }
                                    @endif
                                },
                                @endforeach
                            },
                        }
                        @endif
                    },
                    @endif
                    @endforeach
                }

                var dataSource1 = function (options, callback) {
                    var $data = null
                    if (!("text" in options) && !("type" in options)) {
                        $data = tree_data;//the root tree
                        callback({data: $data});
                        return;
                    }
                    else if ("type" in options && options.type == "folder") {
                        if ("additionalParameters" in options && "children" in options.additionalParameters)
                            $data = options.additionalParameters.children || {};
                        else $data = {}//no data
                    }

                    if ($data != null)//this setTimeout is only for mimicking some random delay
                        setTimeout(function () {
                            callback({data: $data});
                        }, parseInt(Math.random() * 500) + 200);

                    //we have used static data here
                    //but you can retrieve your data dynamically from a server using ajax call
                    //checkout examples/treeview.html and examples/treeview.js for more info
                }

                return {'dataSource1': dataSource1}
            }

// TODO: upate phase 2
            //flot chart resize plugin, somehow manipulates default browser resize event to optimize it!
            //but sometimes it brings up errors with normal resize event handlers
            $.resize.throttleWindow = false;

            var placeholder = $('#piechart-placeholder').css({'width': '90%', 'min-height': '150px'});
            var data = [
                {label: "简历", data: 38.7, color: "#68BC31"},
                {label: "流水线", data: 24.5, color: "#2091CF"},
                {label: "职位", data: 8.2, color: "#AF4E96"},
                {label: "客户", data: 18.6, color: "#DA5430"},
                {label: "项目", data: 10, color: "#FEE074"}
            ]

            function drawPieChart(placeholder, data, position) {
                $.plot(placeholder, data, {
                    series: {
                        pie: {
                            show: true,
                            tilt: 0.8,
                            highlight: {
                                opacity: 0.25
                            },
                            stroke: {
                                color: '#fff',
                                width: 2
                            },
                            startAngle: 2
                        }
                    },
                    legend: {
                        show: true,
                        position: position || "ne",
                        labelBoxBorderColor: null,
                        margin: [-30, 15]
                    }
                    ,
                    grid: {
                        hoverable: true,
                        clickable: true
                    }
                })
            }

            drawPieChart(placeholder, data);

            /**
             we saved the drawing function and the data to redraw with different position later when switching to RTL mode dynamically
             so that's not needed actually.
             */
            placeholder.data('chart', data);
            placeholder.data('draw', drawPieChart);


            //pie chart tooltip example
            var $tooltip = $("<div class='tooltip top in'><div class='tooltip-inner'></div></div>").hide().appendTo('body');
            var previousPoint = null;

            placeholder.on('plothover', function (event, pos, item) {
                if (item) {
                    if (previousPoint != item.seriesIndex) {
                        previousPoint = item.seriesIndex;
                        var tip = item.series['label'] + " : " + item.series['percent'] + '%';
                        $tooltip.show().children(0).text(tip);
                    }
                    $tooltip.css({top: pos.pageY + 10, left: pos.pageX + 10});
                } else {
                    $tooltip.hide();
                    previousPoint = null;
                }

            });
        });
    </script>
@endsection
