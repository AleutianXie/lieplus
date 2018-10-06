@extends('Lieplus::layouts.cici')

@section('title', '简历详情')

@section('content')
    <div class="row">
        <div class="tabbable">
            <ul class="nav nav-tabs padding-2 tab-size-bigger" id="myTab">
                <li @if ('index' == $tab) class="active" @endif>
                    <a href="{{ route('resume.detail', $resume->id) }}" aria-expanded="false">
                        <i class="blue ace-icon fa fa-file-word-o bigger-120"></i>
                        原件
                    </a>
                </li>

                <li @if ('job' == $tab) class="active" @endif>
                    <a href="{{ route('resume.detail', [$resume->id, 'job']) }}" aria-expanded="false">
                        <i class="green ace-icon fa fa-folder bigger-120"></i>
                        简历库
                    </a>
                </li>

                <li @if ('feedback' == $tab) class="active" @endif>
                    <a href="{{ route('resume.detail', [$resume->id, 'feedback']) }}" aria-expanded="true">
                        <i class="orange ace-icon fa fa-comments bigger-120"></i>
                        反馈
                    </a>
                </li>

                <li @if ('notice' == $tab) class="active" @endif>
                    <a href="{{ route('resume.detail',[$resume->id, 'notice']) }}" aria-expanded="true">
                        <i class="purple ace-icon fa fa-bell bigger-120"></i>
                        提醒
                    </a>
                </li>
            </ul>

            <div class="tab-content no-border padding-2">
                {{-- 简历原件--开始 --}}
                <div id="resume-tab-1" @if ('index' == $tab) class="tab-pane fade in active"
                     @else class="tab-pane fade" @endif>
                    <div class="table-header">
                        <i class="ace-icon fa fa-check bigger-110"></i>
                        简历原件
                        <span class="pull-right">{{ Auth::user($resume->created_by)->name }} 发表于 <time
                                datetime="{{ $resume->created_at }}">{{ $resume->created_at }}&nbsp;&nbsp;</time></span>
                    </div>
                    <div class="space-2"></div>
                    <div class="profile-user-info profile-user-info-striped">
                        <div class="profile-info-row">
                            <div class="profile-info-name"> 姓名</div>
                            <div class="profile-info-value">
                                <span>{{ $resume->name }}</span>
                            </div>
                        </div>
                        <div class="profile-info-row">
                            <div class="profile-info-name"> 性别</div>
                            <div class="profile-info-value">
                                <span>{{ config('lieplus.gender.' . $resume->gender) }}</span>
                            </div>
                        </div>
                        <div class="profile-info-row">
                            <div class="profile-info-name"> 手机</div>
                            <div class="profile-info-value">
                                <span>{{ $resume->mobile }}</span>
                            </div>
                        </div>
                        <div class="profile-info-row">
                            <div class="profile-info-name"> 邮箱</div>
                            <div class="profile-info-value">
                                <span>{{ $resume->email }}</span>
                            </div>
                        </div>
                        <div class="profile-info-row">
                            <div class="profile-info-name"> 学历</div>
                            <div class="profile-info-value">
                                <span>{{ config('lieplus.degree.'.$resume->degree) }}</span>
                            </div>
                        </div>
                        <div class="profile-info-row">
                            <div class="profile-info-name"> 城市</div>
                            <div class="profile-info-value">
                                <i class="fa fa-map-marker light-orange bigger-110"></i>
                                <span>{{ $resume->province->name }}</span>
                                <span>{{ $resume->city->name }}</span>
                                <span>{{ $resume->county->name }}</span>
                            </div>
                        </div>
                        <div class="profile-info-row">
                            <div class="profile-info-name"> 出生日期</div>
                            <div class="profile-info-value">
                                <span>{{ $resume->birthdate }}</span>
                            </div>
                        </div>
                        <div class="profile-info-row">
                            <div class="profile-info-name"> 开始工作日期</div>
                            <div class="profile-info-value">
                                <span>{{ $resume->start_work_date }}</span>
                            </div>
                        </div>
                        <div class="profile-info-row">
                            <div class="profile-info-name"> 当前状态</div>
                            <div class="profile-info-value">
                                <span>{{ config('lieplus.service.status.'.$resume->service_status) }}</span>
                            </div>
                        </div>
                        <div class="profile-info-row">
                            <div class="profile-info-name"> 当前行业</div>
                            <div class="profile-info-value">
                                <span>{{ $resume->industry }}</span>
                            </div>
                        </div>
                        <div class="profile-info-row">
                            <div class="profile-info-name"> 当前职位</div>
                            <div class="profile-info-value">
                                <span>{{ $resume->position }}</span>
                            </div>
                        </div>
                        <div class="profile-info-row">
                            <div class="profile-info-name"> 期望薪资</div>
                            <div class="profile-info-value">
                                <span>{{ config('lieplus.salary.'.$resume->salary) }}</span>
                            </div>
                        </div>
                        <div class="profile-info-row">
                            <div class="profile-info-name"> 其它</div>
                            <div class="profile-info-value" style="max-width: 900px; overflow:scroll;">
                                <span>{!! $resume->others !!}</span>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- 简历原件--结束 --}}

                {{-- 已加入的简历库--开始 --}}
                <div id="resume-tab-2" @if ('job' == $tab) class="tab-pane fade in active"
                     @else class="tab-pane fade" @endif>
                    <h4 class="blue">
                        <i class="green ace-icon fa fa-folder bigger-110"></i>
                        已加入的简历库
                    </h4>

                    <div class="space-8"></div>

                </div>
                {{-- 已加入的简历库--结束 --}}

                {{-- 所有反馈信息--开始 --}}
                <div id="resume-tab-3" @if ('feedback' == $tab) class="tab-pane fade in active"
                     @else class="tab-pane fade" @endif>
                    <div class="table-header">
                        <i class="ace-icon fa fa-comments bigger-110"></i>
                        所有反馈信息
                    </div>
                    <div class="space-2"></div>

                    <div class="row">
                        <div class="col-xs-12">
                            <!-- PAGE CONTENT BEGINS -->
                            @foreach($resume->feedbacks->groupBy(function ($item, $key) {
                              return substr($item->created_at, 0, 10);
                            }) as $key => $group)
                                <div id="timeline-2" class="">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-10 col-sm-offset-1">
                                            <div class="timeline-container timeline-style2">
                    <span class="timeline-label">
                      @if ($key == date('Y-m-d'))
                            <b>今天</b>
                        @elseif ($key == date("Y-m-d", strtotime("-1 day")))
                            <b>昨天</b>
                        @else
                            <b>{{ $key }}</b>
                        @endif
                    </span>
                                                @foreach ($group as $feedback)
                                                    <div class="timeline-items">
                                                        <div class="timeline-item clearfix">
                                                            <div class="timeline-info">
                                                                <span
                                                                    class="timeline-date">{{ substr($feedback->created_at, -8) }}</span>
                                                                <i class="timeline-indicator btn btn-info no-hover"></i>
                                                            </div>
                                                            <div class="widget-box transparent">
                                                                <div class="widget-body">
                                                                    <div class="widget-main no-padding">
                              <span class="bigger-110">
                                <a href="#" class="purple bolder">{{ Auth::User($feedback->created_by)->name }}</a>
                                <i class="ace-icon fa fa-comment-o grey"></i>
                                  {{ $feedback->text }}
                              </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div><!-- /.timeline-items -->
                                                @endforeach
                                            </div><!-- /.timeline-container -->
                                        </div>
                                    </div>
                                </div>
                        @endforeach
                        <!-- /.col -->
                        </div>
                    </div>
                </div>
                {{-- 所有反馈信息--结束 --}}

                {{-- 提醒--开始 --}}
                <div id="resume-tab-4" @if ('notice' == $tab) class="tab-pane fade in active"
                     @else class="tab-pane fade" @endif>
                    <h4 class="blue">
                        <i class="purple ace-icon fa fa-bell bigger-110"></i>
                        提醒
                    </h4>

                    <div class="space-8"></div>
                    @include('Lieplus::alert.list', ['alerts' => $resume->alerts ])
                </div>
                {{-- 提醒--结束 --}}
            </div>
        </div>
    </div>
@endsection
