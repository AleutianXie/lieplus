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