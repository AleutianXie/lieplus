<?php

use Illuminate\Database\Seeder;
use App\Resume;

class ResumeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for ($i = 0; $i < 20; $i++)
        {
            $mobile = '159014356' . sprintf('%02d', $i);
            DB::table('resumes')->insert([[
                'sn' => 'JL' . date('Ymdhis', time()) . sprintf('%04d', mt_rand(0, 9999)),
                'name' => '谢辉生',
                'mobile' => $mobile,
                'email' => 'aleutian.xie' . $i . '@ciciosft.cn',
                'gender' => 0,
                'birthdate' => '1993-03-09',
                'startworkdate' => '2016-11-13',
                'degree' => 1,
                'servicestatus' => 0,
                'province' => '110000',
                'city' => '110100',
                'county' => '110105',
                'position' => 'SDE',
                'industry' => 'internet',
                'salary' => 0,
                'others' => '<p></p><div><h1>求助，为什么会is not defined x<br></h1>
<div>

<div><a target="_blank" rel="nofollow"></a><a target="_blank" rel="nofollow" href="http://v.t.sina.com.cn/share/share.php?url=http%3A%2F%2Fzhidao.baidu.com%2Fquestion%2F875428589946601812%3Fsharesource%3Dweibo&amp;title=%E6%B1%82%E5%8A%A9%EF%BC%8C%E4%B8%BA%E4%BB%80%E4%B9%88%E4%BC%9Ais%20not%20defined_%E7%99%BE%E5%BA%A6%E7%9F%A5%E9%81%93&amp;pic=https%3A%2F%2Fgss0.bdstatic.com%2F70cFsjip0QIZ8tyhnq%2Fimg%2Fiknow%2Fzhidaologo.png"></a><a target="_blank" rel="nofollow" href="http://connect.qq.com/widget/shareqq/index.html?url=http%3A%2F%2Fzhidao.baidu.com%2Fquestion%2F875428589946601812%3Fsharesource%3Dqq&amp;title=%E6%B1%82%E5%8A%A9%EF%BC%8C%E4%B8%BA%E4%BB%80%E4%B9%88%E4%BC%9Ais%20not%20defined_%E7%99%BE%E5%BA%A6%E7%9F%A5%E9%81%93&amp;pics=https%3A%2F%2Fgss0.bdstatic.com%2F70cFsjip0QIZ8tyhnq%2Fimg%2Fiknow%2Fzhidaologo.png"></a><a target="_blank" rel="nofollow" href="http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url=http%3A%2F%2Fzhidao.baidu.com%2Fquestion%2F875428589946601812%3Fsharesource%3Dqzone&amp;title=%E6%B1%82%E5%8A%A9%EF%BC%8C%E4%B8%BA%E4%BB%80%E4%B9%88%E4%BC%9Ais%20not%20defined_%E7%99%BE%E5%BA%A6%E7%9F%A5%E9%81%93&amp;pics=https%3A%2F%2Fgss0.bdstatic.com%2F70cFsjip0QIZ8tyhnq%2Fimg%2Fiknow%2Fzhidaologo.png"></a></div>

<a target="_blank" rel="nofollow" href="http://zhidao.baidu.com/usercenter?uid=b6114069236f25705e79b116" title="Link: http://zhidao.baidu.com/usercenter?uid=b6114069236f25705e79b116">果果市渡1</a>
| 浏览 48 次

</div>
</div>


<div>
<div>

发布于2016-03-28 12:08

<div></div>

最佳答案
</div>
<div>
<div>
</div>
<div>
<pre>没太明白你是要问的什么问题，我就按我理解的回答你吧。 is not defined：未定义 你理解你可能是要问为什么define在这里要用过去式defined？ is not defined，意思是“未定义，不是就能定义的“，这里要理解成”.未被定义，不是就能</pre>
<div>
</div><div>
<div>
<i></i>
本回答由提问者推荐</div>
<div>

<i></i>评论
<div>
<i></i><b>0</b>
<i></i><b>0</b>
</div>
</div>
</div>
</div>
</div>
<div>
<div>
<div>
<p>
<a target="_blank" rel="nofollow" href="http://zhidao.baidu.com/usercenter?uid=7b644069236f25705e79100a">
<img alt="" src="https://gss0.bdstatic.com/70cFsj3f_gcX8t7mm9GUKT-xh_/avatar/100/r6s1g15.gif"></a>
</p>
</div>
<div>
<p>
<a target="_blank" rel="nofollow" href="http://zhidao.baidu.com/usercenter?uid=7b644069236f25705e79100a">
yzxbjdx1
</a>
<a target="_blank" rel="nofollow" href="http://www.baidu.com/search/zhidao_help.html#%E5%A6%82%E4%BD%95%E9%80%89%E6%8B%A9%E5%A4%B4%E8%A1%94"></a>
</p>
<p>
采纳率：57%
来自团队：<a target="_blank" rel="nofollow" href="https://zhidao.baidu.com/uteam/view?fr=qb&amp;teamId=91081">知道终极团</a>
擅长：
<a target="_blank" rel="nofollow" href="http://zhidao.baidu.com/browse/786">银行业务</a>
</p>
</div>
</div>
</div>
</div><br><p></p>





<style type="text/css">
p.p1 {margin: 0.0px 0.0px 0.0px 0.0px; font: 12.0px Times; color: #000000; -webkit-text-stroke: #000000}
p.p2 {margin: 0.0px 0.0px 0.0px 0.0px; font: 12.0px Times; color: #000000; -webkit-text-stroke: #000000; min-height: 14.0px}
p.p3 {margin: 0.0px 0.0px 0.0px 0.0px; font: 14.5px Times; color: #000000; -webkit-text-stroke: #000000}
span.s1 {font-kerning: none}
</style>


<p class="p1"><span class="s1"><b>名词分类：</b></span></p>
<p class="p2"><span class="s1"></span><br></p>
<p class="p2"><span class="s1"></span><br></p>
<p class="p2"><span class="s1"></span><br></p>
<p class="p2"><span class="s1"></span><br></p>
<p class="p1"><span class="s1">1、用户名：</span></p>
<p class="p1"><span class="s1">账号是由部门经理以及以上的管理员，分配给员工的账号，同一账号，可以有不同的用户角色。目前在这个，系统之中，所有用户角色包括：管理员，部门经理，客户顾问，招聘顾问，bd开发。</span></p>
<p class="p2"><span class="s1"></span><br></p>
<p class="p1"><span class="s1">2、一级目录。：简历管理，客户管理，职位管理，交付管理，我的工作台，我的六个一级目录</span></p>
<p class="p2"><span class="s1"></span><br></p>
<p class="p2"><span class="s1"></span><br></p>
<p class="p2"><span class="s1"></span><br></p>
<p class="p2"><span class="s1"></span><br></p>
<p class="p2"><span class="s1"></span><br></p>
<p class="p3"><span class="s1"><b>从不同用户角度来描述工作状态</b></span></p>
<p class="p2"><span class="s1"></span><br></p>
<p class="p1"><span class="s1"><b>系统的主要特征是，计划+提醒</b></span></p>
<p class="p1"><span class="s1">计划，包括公司的目标。部门的目标，个人的目标，计划等同于目标，招聘顾问的个人计划，就是制定，当天要做的职位流水线有哪些？当天的个人计划将会被直接反馈到我的工作台上。计划中所选择的几个，职位流水线，这些职位交付流水线就会被放到我的工作台中，那就相当于说这一天他就只做，这几个，职位流水线的，候选人，联系候选人沟通。</span></p>
<p class="p1"><span class="s1">提醒，包括两个，一个是主动提醒，一个是被动提醒</span></p>
<p class="p1"><span class="s1">总结，根据当天完成的计划情况，变成一个日报总结。</span></p>
<p class="p2"><span class="s1"></span><br></p>
<p class="p1"><span class="s1"><b>部门经理的计划，提醒，总结。分配</b></span></p>
<p class="p1"><span class="s1">行业经理的计划，最少是周计划，其次是月度计划，这个计划的就围绕着，职位的分配，office数，入职人数，回款数字，来进行。</span></p>
<p class="p1"><span class="s1">提醒，</span></p>
<p class="p1"><span class="s1">主动提醒，依然如，所有人的一样，记录时间，在日历上提醒。</span></p>
<p class="p1"><span class="s1">被动提醒，被系统提醒，主要是自己的客户顾问，没有按时处理简历，自己的招聘顾问，没有及时的处理一些提醒，这个能设置一个规则，就是下属提醒，如果逾期一个小时，则全部反应在其他人未完成提醒这里。</span></p>
<p class="p2"><span class="s1"></span><br></p>
<p class="p1"><span class="s1">总结</span></p>
<p class="p1"><span class="s1">可以形成一些仪表盘，把这些数字，通过，的一些办法把它转换出来，看得到。</span></p>
<p class="p1"><span class="s1">分配，</span></p>
<p class="p1"><span class="s1">部门经理的分配，主要是将职位分配给某一个，下属让其成为这个职位的客户顾问，将某一个职位分配给招聘顾问，变成这个招聘顾问的指定专属职位等等，这样的分配，一个是分配职责，一个是分配任务。</span></p>
<p class="p2"><span class="s1"></span><br></p>
<p class="p1"><span class="s1">将客户分配给某个账号使其成为客户顾问</span></p>
<p class="p2"><span class="s1"></span><br></p>
<p class="p1"><span class="s1"><b>客户顾问的，计划，提醒，总结，审批</b></span></p>
<p class="p1"><span class="s1">&nbsp;</span></p>
<p class="p1"><span class="s1">客户顾问的计划包括两个，一个是自己的职位重点放在哪些职位上？对职位进行一个分级别？另外一个计划，是已经推荐的最佳候选人，哪一些需要跟后客户沟通，需要居中协调的。</span></p>
<p class="p2"><span class="s1"></span><br></p>
<p class="p1"><span class="s1">提醒的话也是分成两个，一个是主动的提醒，自己记录的一些事情来提醒，另外的一个是被动的提醒，被动提醒，主要是在工作台中，有一些特定的候选人进入某个工作台，就需要去提醒，去操作在某一个工作台的候选人，多长时间去定期的维护，都会有一定的规则，按照这些规则会，从，候选人，进入这个工作台开始，一定的时间就会推送给客户顾问，去注意这些提醒的内容</span></p>
<p class="p2"><span class="s1"></span><br></p>
<p class="p1"><span class="s1">总结的话主要有两个总结，一个是，候选人的总结，一个是职位的总结。</span></p>
<p class="p2"><span class="s1"></span><br></p>
<p class="p1"><span class="s1">因为一个账号，可以是不同的用户，所以，在主页应该显示出他的主要身份，也要显示他的每一个身份的提醒，以便于他能即使跳转到不同的用户。</span></p>
<p class="p2"><span class="s1"></span><br></p>
<p class="p2"><span class="s1"></span><br></p>
<p class="p2"><span class="s1"></span><br></p>
<p class="p1"><span class="s1">审批：审批职位是否可以分配给某个招聘顾问。</span></p>
<p class="p1"><span class="s1">审批：招聘顾问推荐的候选人在推荐中工作台的准入</span></p>
<p class="p2"><span class="s1"></span><br></p>
<p class="p2"><span class="s1"></span><br></p>
<p class="p1"><span class="s1"><b>招聘顾问的计划，提醒，总结、审批</b></span></p>
<p class="p1"><span class="s1">&nbsp;</span></p>
<p class="p1"><span class="s1">招聘的计划主要是自己有很多的职位，那么我们今天主要做哪些职位？这些职位就会自然而然的，出现在了我的工作台中。</span></p>
<p class="p2"><span class="s1"></span><br></p>
<p class="p1"><span class="s1">所以招聘顾问的职位交付流水线，还需要一个，今日的，职位交付流水线。</span></p>
<p class="p2"><span class="s1"></span><br></p>
<p class="p1"><span class="s1">提醒的话也是分成两个，一个是主动的提醒，自己记录的一些事情来提醒，另外的一个是被动的提醒，被动提醒，主要是在工作台中，有一些特定的候选人进入某个工作台，就需要去提醒，去操作在某一个工作台的候选人，多长时间去定期的维护，都会有一定的规则，按照这些规则会，从，候选人，进入这个工作台开始，一定的时间就会推送给客户顾问，去注意这些提醒的内容</span></p>
<p class="p2"><span class="s1"></span><br></p>
<p class="p1"><span class="s1">总结的话主要有两个总结，一个是，候选人的总结，一个是职位的总结。</span></p>
<p class="p2"><span class="s1"></span><br></p>
<p class="p2"><span class="s1"></span><br></p>
<p class="p2"><span class="s1"></span><br></p>
<p class="p2"><span class="s1"></span><br></p>
<p class="p1"><span class="s1"><b>举例：</b>例如说，在你的，面试中，有人，是面试时间是固定的，那在这个时间的，前一天，六点就会提醒你要，确认明天是否能够参加面试，当天面试的，上午的是九点，提醒你要确认一下这个人能否参加面试？下午的，在11点半，提醒你，确认候选人能不能参加？</span></p>
<p class="p2"><span class="s1"></span><br></p>
<p class="p2"><span class="s1"></span><br></p>
<p class="p2"><span class="s1"></span><br></p>
<p class="p3"><span class="s1"><b>BD、招聘顾问、客户顾问、leader的工作状态简介</b></span></p>
<p class="p2"><span class="s1"></span><br></p>
<p class="p1"><span class="s1"><b>bd的工作状态，</b></span></p>
<p class="p2"><span class="s1"></span><br></p>
<p class="p1"><span class="s1">BD的工作唯一就是，发动一个项目启动书。填写格式如公司的项目启动书（附表一，项目启动书）</span></p>
<p class="p2"><span class="s1"></span><br></p>
<p class="p2"><span class="s1"></span><br></p>
<p class="p1"><span class="s1"><b>招聘顾问的工作状态，</b></span></p>
<p class="p2"><span class="s1"></span><br></p>
<p class="p1"><span class="s1">招聘顾问的工作只在一个我的工作台，可以完成所有的工作。</span></p>
<p class="p1"><span class="s1">计划：制定自己的职位计划，今天做多少个职位，职位分为了：指定专属职位，专属职位，公共池职位。</span></p>
<p class="p1"><span class="s1">提醒：可以在所有简历上有这个提醒按钮，可以直接在桌面上有提醒按钮。</span></p>
<p class="p1"><span class="s1">搜索简历：可以直接有搜索选项，并且，默认的都是所有简历库。搜索结果可以直接跳转所有简历搜索的结果。</span></p>
<p class="p1"><span class="s1">推荐候选人：在工作台中可实现</span></p>
<p class="p1"><span class="s1">搜索职位：申请职位，</span></p>
<p class="p1"><span class="s1">申请职位：</span></p>
<p class="p1"><span class="s1">上传候选人：到某一个职位简历库。</span></p>
<p class="p2"><span class="s1"></span><br></p>
<p class="p1"><span class="s1"><b>以上这些全部是按钮或者在我的下拉菜单中，</b></span></p>
<p class="p1"><span class="s1">而招聘顾问的日常工作则是在我的工作台完全实现。</span></p>
<p class="p2"><span class="s1"></span><br></p>
<p class="p1"><span class="s1"><b>客户顾问的工作状态，</b></span></p>
<p class="p2"><span class="s1"></span><br></p>
<p class="p1"><span class="s1">客户顾问的主要完成的工作：</span></p>
<p class="p1"><span class="s1">完成自己负责的职位信息更新：公司介绍，职位介绍，部门介绍，面试反馈。</span></p>
<p class="p1"><span class="s1">在工作台中，招聘顾问职位的候选人，在推荐中，面试中，offer中，入职中的状态标注和回复信息内容。</span></p>
<p class="p1"><span class="s1">回答，在职位之中，招聘顾问所提问题。并将这些问题一一记录下来。</span></p>
<p class="p1"><span class="s1">将自己负责的职位分为：open，close，同时，在每周Open中的职位，标记20%左右的职位为重点职位。</span></p>
<p class="p2"><span class="s1"></span><br></p>
<p class="p1"><span class="s1"><b>客户顾问的重要职责：</b>推荐中的简历，不能直接进入推荐中，需要提醒客户顾问，客户顾问同意，才能进入推荐中工作台，所以，在客户顾问的推荐中工作台，最重要的是批准能够进入这个工作台的候选人。</span></p>
<p class="p2"><span class="s1"></span><br></p>
<p class="p1"><span class="s1">客户顾问工作台，还需要增加一个我的职位汇总。</span></p>
<p class="p2"><span class="s1"></span><br></p>
<p class="p2"><span class="s1"></span><br></p>
<p class="p1"><span class="s1"><b>部门经理的工作状态，</b></span></p>
<p class="p2"><span class="s1"></span><br></p>
<p class="p1"><span class="s1">部门经理的工作只在一个我的工作台，可以完成所有的工作。</span></p>
<p class="p1"><span class="s1">计划：制定自己部门的周计划，月度计划，主要是将自己负责的职位按照客户顾问给的重要程度来将公共池中的职位划分给招聘顾问作为制定专属职位分配给招聘顾问。</span></p>
<p class="p1"><span class="s1">提醒：自己下属的重要提醒超过1个小时无反馈的，全部集中到部门经理这里来。</span></p>
<p class="p1"><span class="s1">工作台：拥有所有下属的职位流水线，并具备所有的权限。可以随意切换到不同的用户角色。</span></p>
<p class="p2"><span class="s1"></span><br></p>
<p class="p2"><span class="s1"></span><br></p>
<p class="p1"><span class="s1">设计的问题工作台是指定专属职位，专属职位，只能是某个人来做，在其招聘顾问的工作台上不能操作。</span></p>
<p class="p2"><span class="s1"></span><br></p>
<p class="p2"><span class="s1"></span><br></p>
<p class="p1"><span class="s1">从几个角度来说全流程吧！</span></p>
<p class="p1"><span class="s1">1、招聘的角度，</span></p>
<p class="p1"><span class="s1">2、客户顾问的角度</span></p>
<p class="p1"><span class="s1">3、部门经理</span></p>
<p class="p1"><span class="s1">4、满足一个职位招流程聘。</span></p>
<p class="p2"><span class="s1"></span><br></p>
<p class="p1"><span class="s1"><b>满足一个职位招流程聘 整个流程，</b></span></p>
<p class="p2"><span class="s1"></span><br></p>
<p class="p1"><span class="s1">1、bd开发填写项目启动书</span></p>
<p class="p1"><span class="s1">2、行业经理审批通过，并将这个客户分配到某个用户，使其成为这个客户的所有职位的客户顾问</span></p>
<p class="p1"><span class="s1">3、客户顾问将所有职位发布出来，并逐渐更新资料，回答问题，</span></p>
<p class="p1"><span class="s1">4、审批所有招聘顾问的申请，通过之后将会给招聘顾问的工作台增加一个职位流水线。</span></p>
<p class="p1"><span class="s1">5、招聘顾问申请并得到这个流水线，如果这个职位流水线不是某个人的指定专属职位，或者是专属职位，那么招聘顾问就可以操作这个职位了流水线了，</span></p>
<p class="p1"><span class="s1">6、职位流水线有自带的一个职位简历库，命名原则是，1开头的6位数字123456，这个职位简历库有排重的功能，不能重复，可以由招聘顾问，客户顾问，部门经理上传简历。其中，客户顾问，部门经理上传简历要指定招聘顾问，这样的话，这些上传的简历将会直接进入到招聘顾问的未联系工作台</span></p>
<p class="p1"><span class="s1">7，根据工作台原则，不断推荐最后满足上需求。</span></p>
<p class="p1"><span class="s1">8、客户顾问或者部门经理将职位的状态设置成close。将不允许大家在操作这个职位流水线，则，整个过程完了。</span></p>
            ',
                'creater' => 1,
                'modifier' => 1,
                'created_at' => date('Y-m-d h:i:s', time()),
                'updated_at' => date('Y-m-d h:i:s', time())]]);

            $rid = Resume::where(['mobile' => $mobile])->value('id');
            DB::table('mylibraries')->insert([
                'uid' => 1,
                'rid' => $rid,
                'show' => 1,
                'creater' => 1,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ]);
        }
    }
}
