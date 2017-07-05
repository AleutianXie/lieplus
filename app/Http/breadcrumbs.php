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
Breadcrumbs::register('resume.add', function ($breadcrumbs)
{
    $breadcrumbs->parent('resume');
    $breadcrumbs->push('新建', route('resume.add'));
});

// Home > Resume > Detail
Breadcrumbs::register('resume.detail', function ($breadcrumbs, $id)
{
    $breadcrumbs->parent('resume');
    $breadcrumbs->push('详情', route('resume.detail', $id));
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
    $breadcrumbs->push('猎帮简历库', route('resume.all'));
});

// Home > UserCenter
Breadcrumbs::register('user.profile', function ($breadcrumbs, $id)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('用户中心', route('user.profile', $id));
});