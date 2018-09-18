@if (Auth::check())
<div id="sidebar" class="sidebar responsive ace-save-state">
    <div class="sidebar-shortcuts" id="sidebar-shortcuts">
        <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
            <button class="btn btn-success">
                <i class="ace-icon fa fa-list"></i>
            </button>
            <button class="btn btn-info">
                <i class="ace-icon fa fa-users"></i>
            </button>
            <button class="btn btn-warning">
                <i class="ace-icon fa fa-slideshare"></i>
            </button>
            <button class="btn btn-danger">
                <i class="ace-icon fa fa-tachometer"></i>
            </button>
        </div>
        <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
            <span class="btn btn-success"></span>
            <span class="btn btn-info"></span>
            <span class="btn btn-warning"></span>
            <span class="btn btn-danger"></span>
        </div>
    </div>
    <!-- /.sidebar-shortcuts -->

    <ul class="nav nav-list">
        <li @if(Request::fullUrl() == route('home')) class="active" @endif>
            <a href="/">
                <i class="menu-icon fa fa-home"></i>
                <span class="menu-text"> 首页 </span>
            </a>
            <b class="arrow"></b>
        </li>
        @hasanyrole('admin|manager|customer|recruiter')
        <li @if(starts_with(Request::fullUrl(), route('resume'))) class="open" @endif>
            <a href="javascript:void(0)" class="dropdown-toggle">
                <i class="menu-icon fa fa-list"></i>
                <span class="menu-text"> 简历 </span>
                <b class="arrow fa fa-angle-down"></b>
            </a>
            <b class="arrow"></b>
            <ul class="submenu">
                <li @if(starts_with(Request::fullUrl(), route('resume.create'))) class="active" @endif>
                    <a href="{{ route('resume.create') }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        创建
                    </a>
                    <b class="arrow"></b>
                </li>
                <li @if(starts_with(Request::fullUrl(), route('resume.my'))) class="active" @endif>
                    <a href="{{ route('resume.my') }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        我的简历库
                    </a>
                    <b class="arrow"></b>
                </li>
                <li @if(starts_with(Request::fullUrl(), route('resume.job'))) class="active" @endif>
                    <a href="{{ route('resume.job') }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        职位简历库
                    </a>
                    <b class="arrow"></b>
                </li>
                <li @if(starts_with(Request::fullUrl(), route('resume.all'))) class="active" @endif>
                    <a href="{{ route('resume.all') }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        金领航简历库
                    </a>
                    <b class="arrow"></b>
                </li>
            </ul>
        </li>
        <li @if(starts_with(Request::fullUrl(), route('customer'))) class="open" @endif>
            <a href="javascript:void(0)" class="dropdown-toggle">
                <i class="menu-icon fa fa-users"></i>
                <span class="menu-text">
                    客户
                </span>
                <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>

            <ul class="submenu">
                <li @if(starts_with(Request::fullUrl(), route('customer.index'))) class="active" @endif>
                    <a href="{{ route('customer.index') }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        我的客户
                    </a>

                    <b class="arrow"></b>
                </li>
                <li @if(starts_with(Request::fullUrl(), route('customer.all'))) class="active" @endif>
                    <a href="{{ route('customer.all') }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        金领航客户
                    </a>
                    <b class="arrow"></b>
                </li>
            </ul>
        </li>
        @endhasanyrole

        @hasanyrole('admin|manager|bd')
        <li @if(starts_with(Request::fullUrl(), route('project'))) class="open" @endif">
            <a href="javascript:void(0)" class="dropdown-toggle">
                <i class="menu-icon fa fa-list-ol"></i>
                <span class="menu-text">
                    项目
                </span>

                <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>

            <ul class="submenu">
                @hasanyrole('admin|bd')
                <li @if(starts_with(Request::fullUrl(), route('project.index'))) class="active" @endif>
                    <a href="{{ route('project.index') }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        项目启动书
                    </a>

                    <b class="arrow"></b>
                </li>
                @endhasanyrole
                @hasanyrole('admin|manager')
                <li @if(starts_with(Request::fullUrl(), route('project.audit'))) class="active" @endif>
                    <a href="{{ route('project.audit') }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        项目审批
                    </a>

                    <b class="arrow"></b>
                </li>
                @endhasanyrole
            </ul>
        </li>
        @endhasanyrole

        @hasanyrole('admin|manager|customer')
        <li @if(starts_with(Request::fullUrl(), route('job'))) class="open" @endif>
            <a href="javascript:void(0)" class="dropdown-toggle">
                <i class="menu-icon fa fa-slideshare"></i>
                <span class="menu-text">
                    职位
                </span>

                <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>

            <ul class="submenu">
                <li  @if(starts_with(Request::fullUrl(), route('job.add'))) class="active" @endif>
                    <a href="{{ route('job.add') }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        创建
                    </a>

                    <b class="arrow"></b>
                </li>
                <li  @if(starts_with(Request::fullUrl(), route('job.index'))) class="active" @endif>
                <a href="{{ route('job.index') }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        我的职位
                    </a>

                    <b class="arrow"></b>
                </li>
                <li  @if(starts_with(Request::fullUrl(), route('job.all'))) class="active" @endif>
                <a href="{{ route('job.all') }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        金领航职位
                    </a>

                    <b class="arrow"></b>
                </li>
            </ul>
        </li>
        @endhasanyrole
        @hasanyrole('admin|manager|customer|recruiter')
        <li @if(starts_with(Request::fullUrl(), route('line'))) class="open" @endif>
            <a href="javascript:void(0)" class="dropdown-toggle">
                <i class="menu-icon fa fa-tachometer"></i>
                <span class="menu-text"> 流水线 </span>

                <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>

            <ul class="submenu">
                @hasanyrole('admin|manager|recruiter')
                <li @if(starts_with(Request::fullUrl(), route('line.index'))) class="active" @endif>
                    <a href="{{ route('line.index') }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        我负责招聘的流水线
                    </a>

                    <b class="arrow"></b>
                </li>
                @endhasanyrole
                @hasanyrole('admin|manager|customer')
                <li @if(starts_with(Request::fullUrl(), route('line.customer'))) class="active" @endif>
                    <a href="{{ route('line.customer') }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        我负责客户的流水线
                    </a>

                    <b class="arrow"></b>
                </li>
                @endhasanyrole
                @hasanyrole('admin|manager')
                <li @if(starts_with(Request::fullUrl(), route('line.all'))) class="active" @endif>
                    <a href="{{ route('line.all') }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        猎加职位流水线
                    </a>

                    <b class="arrow"></b>
                </li>
                @endhasanyrole
            </ul>
        </li>
        <li @if(starts_with(Request::fullUrl(), route('line.plan'))) class="active" @endif>
            <a href="{{ route('line.plan') }}">
                <i class="menu-icon fa fa-cc"></i>
                <span class="menu-text"> 今日工作台 </span>
            </a>

            <b class="arrow"></b>
        </li>
        @endhasanyrole
    </ul><!-- /.nav-list -->

    <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
        <i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
    </div>
</div>
@endif
