<?php
// Home
Breadcrumbs::register('home', function ($breadcrumbs)
{
    $breadcrumbs->push('首页', route('home'));
});

// Home > Resume
Breadcrumbs::register('resume', function ($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('简历', route('resume'));
});

// Home > Resume > Add
Breadcrumbs::register('resume.create', function ($breadcrumbs)
{
    $breadcrumbs->parent('resume');
    $breadcrumbs->push('新建', route('resume.create'));
});

// Home > Resume > Detail
Breadcrumbs::register('resume.detail', function ($breadcrumbs, $id)
{
    $breadcrumbs->parent('resume');
    $breadcrumbs->push('详情', route('resume.detail', $id));
});

// Home > Resume > Edit
Breadcrumbs::register('resume.edit', function ($breadcrumbs, $id)
{
    $breadcrumbs->parent('resume');
    $breadcrumbs->push('编辑', route('resume.edit', $id));
});

// Home > Resume > My
Breadcrumbs::register('resume.my', function ($breadcrumbs)
{
    $breadcrumbs->parent('resume');
    $breadcrumbs->push('我的简历库', route('resume.my'));
});

// Home > Resume > Job
Breadcrumbs::register('resume.job', function ($breadcrumbs)
{
    $breadcrumbs->parent('resume');
    $breadcrumbs->push('我的职位简历库', route('resume.job'));
});

// Home > Resume > All
Breadcrumbs::register('resume.all', function ($breadcrumbs)
{
    $breadcrumbs->parent('resume');
    $breadcrumbs->push('金领航简历库', route('resume.all'));
});

// Home > UserCenter
Breadcrumbs::register('user.detail', function ($breadcrumbs, $id)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('用户中心', route('user.detail', $id));
});

// Home
Breadcrumbs::register('user.index', function ($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('用户列表', route('user.index'));
});

// Home > Job
Breadcrumbs::register('job', function ($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('职位', route('job'));
});
// Home > Job > all
Breadcrumbs::register('job.all', function ($breadcrumbs)
{
    $breadcrumbs->parent('job');
    $breadcrumbs->push('金领航职位', route('job.all'));
});
// Home > Job > index
Breadcrumbs::register('job.index', function ($breadcrumbs)
{
    $breadcrumbs->parent('job');
    $breadcrumbs->push('我的职位', route('job.index'));
});
// Home > Job > detail
Breadcrumbs::register('job.detail', function ($breadcrumbs, $id)
{
    $breadcrumbs->parent('job');
    $breadcrumbs->push('职位详情', route('job.detail', $id));
});

// Home > Job > add
Breadcrumbs::register('job.add', function ($breadcrumbs)
{
    $breadcrumbs->parent('job');
    $breadcrumbs->push('新建职位', route('job.add'));
});

// Home > Job
Breadcrumbs::register('project', function ($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('项目启动书', route('project'));
});

// Home > Job > detail
Breadcrumbs::register('project.detail', function ($breadcrumbs, $id)
{
    $breadcrumbs->parent('project');
    $breadcrumbs->push('项目启动书详细', route('project.detail', $id));
});

// Home > Job > audit
Breadcrumbs::register('project.audit', function ($breadcrumbs)
{
    $breadcrumbs->parent('project');
    $breadcrumbs->push('项目审批', route('project.audit'));
});

// Home > Customer
Breadcrumbs::register('customer', function ($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('客户', route('customer'));
});

// Home > Customer > index
Breadcrumbs::register('customer.index', function ($breadcrumbs)
{
    $breadcrumbs->parent('customer');
    $breadcrumbs->push('我的客户', route('customer.index'));
});

// Home > Customer > all
Breadcrumbs::register('customer.all', function ($breadcrumbs)
{
    $breadcrumbs->parent('customer');
    $breadcrumbs->push('金领航客户', route('customer.all'));
});

// Home > Customer > detail
Breadcrumbs::register('customer.detail', function ($breadcrumbs, $id)
{
    $breadcrumbs->parent('customer');
    $breadcrumbs->push('客户详情', route('customer.detail', $id));
});

// Home > Line
Breadcrumbs::register('line', function ($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('职位流水线', route('line'));
});

// Home > Line > all
Breadcrumbs::register('line.all', function ($breadcrumbs)
{
    $breadcrumbs->parent('line');
    $breadcrumbs->push('猎加职位流水线', route('line.all'));
});
// Home > Line > index
Breadcrumbs::register('line.index', function ($breadcrumbs)
{
    $breadcrumbs->parent('line');
    $breadcrumbs->push('我负责招聘职位流水线', route('line.index'));
});
Breadcrumbs::register('line.customer', function ($breadcrumbs)
{
    $breadcrumbs->parent('line');
    $breadcrumbs->push('我负责客户职位流水线', route('line.customer'));
});

// Home > Line > detail
Breadcrumbs::register('line.detail', function ($breadcrumbs, $id)
{
    $breadcrumbs->parent('line');
    $breadcrumbs->push('职位流水线详情', route('line.detail', $id));
});

// Home  > plan
Breadcrumbs::register('line.plan', function ($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('今日工作台', route('line.plan'));
});
