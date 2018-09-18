<?php

use Cici\Lieplus\Models\Department;
use Cici\Lieplus\Models\Job;
use Cici\Lieplus\Models\Project;
use Faker\Factory;
use Illuminate\Database\Seeder;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 生成项目启动书
        $faker = Factory::create('zh_CN');
        $department_ids = Department::select(['id', 'customer_id'])->groupBy('customer_id')->pluck('id');
        $job_ids = Job::whereIn('department_id', $department_ids)->select(['id', 'department_id'])->groupBy('department_id')->pluck('id');
        $this->command->line('生成'.count($job_ids).'个项目启动书...'.PHP_EOL);

        $bar = $this->command->getOutput()->createProgressBar(100);
        foreach ($job_ids as $job_id) {
            $attributes = [
                'name' => $faker->unique()->company,
                'job_id' => $job_id,
                'status' => $faker->numberBetween(0, 2),
                'created_by' => 1,
                'updated_by' => 1
            ];

            Project::create($attributes);

            $bar->advance();
        }
        $bar->finish();
        $this->command->line(PHP_EOL.'完成！'.PHP_EOL);
    }
}
