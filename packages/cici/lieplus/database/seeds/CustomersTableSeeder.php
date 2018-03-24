<?php

use Cici\Lieplus\Models\Customer;
use Cici\Lieplus\Models\Department;
use Cici\Lieplus\Models\Job;
use Faker\Factory;
use Illuminate\Database\Seeder;

class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 随机生成100个客户，每个客户10个部门，每个部门10个职位
        $faker = Factory::create('zh_CN');

        $departments = [
            '营业部',
            '人事部 ',
            '人力资源部',
            '总务部',
            '财务部',
            '销售部',
            '促销部',
            '国际部',
            '出口部',
            '进口部',
            '公关部',
            '广告部',
            '企划部',
            '产品开发部',
            '研发部',
            '秘书室',
            '采购部',
            '工程部',
            '行政部',
            '市场部',
            '技术部',
            '客服部',
            '总经理室',
            '副总经理室',
            '总经办',
            '生产部',
            '广东业务部',
            '无线事业部',
            '拓展部',
            '物供部',
            '业务拓展部',
            '会计部',
            '管理部',
            '监事会',
            '战略研究部',
            '外销部',
            '财务科',
            '党支部',
            '质检科',
            '厂长室',
            '档案室',
            '生产科'
        ];

        $positions = [
            '人事部经理',
            '热处理工程师',
            '人力资源行政',
            '人事专员助理',
            '人事业务助理',
            '软件助理',
            '研发工程师',
            '软件开发java实习生',
            '认定工程师',
            '软件开发工程师',
            '软件测工程师',
            '日语人事',
            '人力行政总监',
            '人事助理实习生',
            '人力资源代表',
            '认证专员',
            '人力资源副经理',
            '日语行政',
            '软件开发程序员',
            '人力行政经理',
            '软件JAVA开发工程师',
            '软件主任',
            '人力行政助理',
            '软件测试工程',
            '软件研发助理工程师',
            '软件运营'
        ];

        $this->command->line('随机生成100个客户.');
        $this->command->line('给每个客户生成10个部门.');
        $this->command->line('给每个部门生成10个职位...'.PHP_EOL);

        $bar = $this->command->getOutput()->createProgressBar(100);
        for ($i = 0; $i < 100; $i++) {
            $attributes = [
                'name' => $faker->unique()->company,
                'province' => '110000',
                'city' => '110100',
                'county' => '110105',
                'welfare' => $faker->numberBetween(1, 2),
                'work_time' => $faker->numberBetween(1, 4),
                'founder' => $faker->unique()->name,
                'financing' => $faker->numberBetween(1, 6),
                'industry' => $faker->numberBetween(1, 9),
                'ranking' => $faker->numberBetween(1, 3),
                'property' => $faker->numberBetween(1, 8),
                'size' => $faker->numberBetween(1, 8),
                'introduce' => addslashes($faker->randomHtml()),
                'level' => $faker->numberBetween(1, 3),
                'type' => $faker->numberBetween(1, 3),
                'status' => $faker->numberBetween(1, 2),
                'created_by' => 1,
                'updated_by' => 1
            ];

            $customer = Customer::create($attributes);

            $departmentNames = $faker->randomElements($departments, 10);

            foreach ($departmentNames as $departmentName) {
                $attributes = [
                    'customer_id' => $customer->id,
                    'name' => $departmentName,
                    'created_by' => 1,
                    'updated_by' => 1
                ];
                $department = Department::create($attributes);

                $jobNames = $faker->randomElements($positions, 10);
                foreach ($jobNames as $jobName) {
                    $attributes = [
                        'department_id' => $department->id,
                        'name' => $jobName,
                        'requirement' => addslashes($faker->randomHtml()),
                        'work_years' => $faker->numberBetween(0, 6),
                        'gender' => $faker->numberBetween(0, 2),
                        'majors' => $faker->numberBetween(0, 5),
                        'degree' => $faker->numberBetween(0, 4),
                        'unified' => $faker->numberBetween(0, 1),
                        'salary' => addslashes($faker->randomHtml()),
                        'property' => $faker->numberBetween(1, 3),
                        'closed' => $faker->numberBetween(0, 1),
                        'created_by' => 1,
                        'updated_by' => 1
                    ];
                    Job::create($attributes);
                }
            }

            $bar->advance();
        }
        $bar->finish();
        $this->command->line(PHP_EOL.'完成！'.PHP_EOL);
    }
}
