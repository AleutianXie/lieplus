<?php

use Illuminate\Database\Seeder;

class RolePermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // 部门经理 2, BD 3, 招聘顾问 4, 客户顾问 5
        $permiisons = [
            'resume' => [
                'create' => [
                    'desc' => '新增简历',
                    'value' => [
                        '2' => 1,
                        '3' => 0,
                        '4' => 1,
                        '5' => 0,
                    ],
                ],
                'search' => [
                    'desc' => '搜索简历',
                    'value' => [
                        '2' => 1,
                        '3' => 0,
                        '4' => 1,
                        '5' => 0,
                    ],
                ],
                'view' => [
                    'desc' => '查看简历',
                    'value' => [
                        '2' => 1,
                        '3' => 0,
                        '4' => 1,
                        '5' => 0,
                    ],
                ],
                'update' => [
                    'desc' => '编辑简历',
                    'value' => [
                        '2' => 1,
                        '3' => 0,
                        '4' => 1,
                        '5' => 0,
                    ],
                ],
                'group' => [
                    'desc' => '简历分组',
                    'value' => [
                        '2' => 1,
                        '3' => 0,
                        '4' => 1,
                        '5' => 0,
                    ],
                ],
                'joblibraries' => [
                    'desc' => '加入职位简历库',
                    'value' => [
                        '2' => 1,
                        '3' => 0,
                        '4' => 1,
                        '5' => 0,
                    ],
                ],
                'delete' => [
                    'desc' => '删除简历',
                    'value' => [
                        '2' => 1,
                        '3' => 0,
                        '4' => 1,
                        '5' => 0,
                    ],
                ],
                'alert' => [
                    'desc' => '提醒(对象是简历)',
                    'value' => [
                        '2' => 1,
                        '3' => 0,
                        '4' => 1,
                        '5' => 0,
                    ],
                ],
            ],
            'customer' => [
                'create' => [
                    'desc' => '创建客户',
                    'value' => [
                        '2' => 1,
                        '3' => 0,
                        '4' => 0,
                        '5' => 1,
                    ],
                ],
                'update' => [
                    'desc' => '编辑客户',
                    'value' => [
                        '2' => 1,
                        '3' => 0,
                        '4' => 0,
                        '5' => 1,
                    ],
                ],
                'view' => [
                    'desc' => '查看客户',
                    'value' => [
                        '2' => 1,
                        '3' => 0,
                        '4' => 0,
                        '5' => 1,
                    ],
                ],
                'delete' => [
                    'desc' => '创建客户',
                    'value' => [
                        '2' => 1,
                        '3' => 1,
                        '4' => 0,
                        '5' => 1,
                    ],
                ],
            ],
            'project' => [
                'create' => [
                    'desc' => '创建项目启动书',
                    'value' => [
                        '2' => 1,
                        '3' => 1,
                        '4' => 0,
                        '5' => 0,
                    ],
                ],
                'update' => [
                    'desc' => '编辑项目启动书',
                    'value' => [
                        '2' => 1,
                        '3' => 1,
                        '4' => 0,
                        '5' => 0,
                    ],
                ],
                'view' => [
                    'desc' => '查看项目启动书',
                    'value' => [
                        '2' => 1,
                        '3' => 1,
                        '4' => 0,
                        '5' => 0,
                    ],
                ],
                'delete' => [
                    'desc' => '删除项目启动书',
                    'value' => [
                        '2' => 1,
                        '3' => 1,
                        '4' => 0,
                        '5' => 0,
                    ],
                ],
            ],
            'job' => [
                'create' => [
                    'desc' => '新增职位',
                    'value' => [
                        '2' => 1,
                        '3' => 1,
                        '4' => 0,
                        '5' => 1,
                    ],
                ],
                'update' => [
                    'desc' => '编辑职位',
                    'value' => [
                        '2' => 1,
                        '3' => 0,
                        '4' => 0,
                        '5' => 1,
                    ],
                ],
                'view' => [
                    'desc' => '查看职位',
                    'value' => [
                        '2' => 1,
                        '3' => 0,
                        '4' => 1,
                        '5' => 1,
                    ],
                ],
                'setting' => [
                    'desc' => '设置职位',
                    'value' => [
                        '2' => 1,
                        '3' => 0,
                        '4' => 0,
                        '5' => 1,
                    ],
                ],
            ],
        ];

        foreach ($permiisons as $model => $permiison)
        {
            foreach ($permiison as $action => $list)
            {
                $description = $list['desc'];

                foreach ($list['value'] as $rid => $value)
                {
                    DB::table('role_permissions')->insert([
                        'rid' => $rid,
                        'model' => $model,
                        'action' => $action,
                        'description' => $description,
                        'enabled' => $value,
                        'show' => 1,
                        'creater' => 1,
                        'modifier' => 1,
                        'created_at' => date('Y-m-d H:i:s', time()),
                        'updated_at' => date('Y-m-d H:i:s', time())]);
                }
            }
        }
    }
}
