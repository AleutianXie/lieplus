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
    </div><!-- /.sidebar-shortcuts -->

    <ul class="nav nav-list">
        <li class="active">
            <a href="/">
                <i class="menu-icon fa fa-home"></i>
                <span class="menu-text"> 首页 </span>
            </a>

            <b class="arrow"></b>
        </li>

        <li class="">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-list"></i>
                <span class="menu-text"> 简历 </span>

                <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>

            <ul class="submenu">
                <li class="">
                    <a href="/resume/add">
                        <i class="menu-icon fa fa-caret-right"></i>
                        创建
                    </a>

                    <b class="arrow"></b>
                </li>

                <li class="">
                    <a href="/resume/my">
                        <i class="menu-icon fa fa-caret-right"></i>
                        我的简历库
                    </a>

                    <b class="arrow"></b>
                </li>
                <li class="">
                    <a href="/resume/job">
                        <i class="menu-icon fa fa-caret-right"></i>
                        职位简历库
                    </a>

                    <b class="arrow"></b>
                </li>
                <li class="">
                    <a href="/resume/all">
                        <i class="menu-icon fa fa-caret-right"></i>
                        猎加简历库
                    </a>

                    <b class="arrow"></b>
                </li>
            </ul>
        </li>

        <li class="">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-users"></i>
                <span class="menu-text">
                    客户
                </span>

                <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>

            <ul class="submenu">
                <li class="">
                    <a href="/customer">
                        <i class="menu-icon fa fa-caret-right"></i>
                        我的客户
                    </a>

                    <b class="arrow"></b>
                </li>
                <li class="">
                    <a href="/customer/all">
                        <i class="menu-icon fa fa-caret-right"></i>
                        猎加客户
                    </a>

                    <b class="arrow"></b>
                </li>
            </ul>
        </li>

        <li class="">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-slideshare"></i>
                <span class="menu-text">
                    职位
                </span>

                <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>

            <ul class="submenu">
                <li class="">
                    <a href="/project">
                        <i class="menu-icon fa fa-caret-right"></i>
                        项目启动书
                    </a>

                    <b class="arrow"></b>
                </li>
                <li class="">
                    <a href="/job/add">
                        <i class="menu-icon fa fa-caret-right"></i>
                        创建
                    </a>

                    <b class="arrow"></b>
                </li>
                <li>
                <a href="/job/">
                        <i class="menu-icon fa fa-caret-right"></i>
                        我的职位
                    </a>

                    <b class="arrow"></b>
                </li>
                <li>
                <a href="/job/all">
                        <i class="menu-icon fa fa-caret-right"></i>
                        猎加职位
                    </a>

                    <b class="arrow"></b>
                </li>
            </ul>
        </li>

        <li class="">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-tachometer"></i>
                <span class="menu-text"> 流水线 </span>

                <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>

            <ul class="submenu">
                <li class="">
                    <a href="/line">
                        <i class="menu-icon fa fa-caret-right"></i>
                        我负责招聘的流水线
                    </a>

                    <b class="arrow"></b>
                </li>
                @role('admin|customer')
                <li class="">
                    <a href="/line/customer">
                        <i class="menu-icon fa fa-caret-right"></i>
                        我负责客户的流水线
                    </a>

                    <b class="arrow"></b>
                </li>
                @endrole
                <li class="">
                    <a href="/line/all">
                        <i class="menu-icon fa fa-caret-right"></i>
                        猎加职位流水线
                    </a>

                    <b class="arrow"></b>
                </li>
            </ul>
        </li>

        <li class="">
            <a href="/plan">
                <i class="menu-icon fa fa-cc"></i>
                <span class="menu-text"> 今日工作台 </span>
            </a>

            <b class="arrow"></b>
        </li>
    </ul><!-- /.nav-list -->

    <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
        <i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
    </div>
</div>