@if (Auth::check())
<div class="navbar-buttons navbar-header pull-right" role="navigation">
    <ul class="nav ace-nav">
        <li class="light-blue dropdown-modal">
            <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                <img class="nav-user-photo" src="{{ asset('images/avatars/user.jpg') }}" alt="Jason's Photo" />
                <span class="user-info">
                    <small>欢迎,</small>
                    {{ Auth::user()->name }}
                </span>

                <i class="ace-icon fa fa-caret-down"></i>
            </a>

            <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                @role('admin')
                <li>
                    <a href="{{ url('/user/'.Auth::id().'#settings') }}">
                        <i class="ace-icon fa fa-cog"></i>
                        设置
                    </a>
                </li>
                @endrole

                <li>
                    <a href="{{ url('/user/'.Auth::id().'#baseinfo') }}">
                        <i class="ace-icon fa fa-user"></i>
                        用户中心
                    </a>
                </li>

                @role('admin')
                <li>
                    <a href="{{ url('/admin') }}">
                        <i class="ace-icon fa fa-user"></i>
                        用户管理
                    </a>
                </li>
                @endrole
                <li class="divider"></li>

                <li>
                    <a href="{{ url('/logout') }}"  onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        <i class="ace-icon fa fa-power-off"></i>
                        退出
                    </a>
                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            </ul>
        </li>
    </ul>
</div>
@endif