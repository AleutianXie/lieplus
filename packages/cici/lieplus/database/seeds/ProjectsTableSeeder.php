<?php

use App\User;
use Cici\Lieplus\Models\Department;
use Cici\Lieplus\Models\Job;
use Cici\Lieplus\Models\Project;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::role('admin')->first();
        Auth::login($user);
        // 生成项目启动书
        $faker = Factory::create('zh_CN');
        $customer_ids = Department::select(['id', 'customer_id'])->groupBy('customer_id')->pluck('customer_id', 'id')->toArray();
        $department_ids = array_keys($customer_ids);

        $jobs = Job::whereIn('department_id', $department_ids)->select(['id', 'department_id'])->groupBy('department_id')->pluck('id', 'department_id')->toArray();
        $this->command->info('生成'.count($jobs).'个项目启动书...');

        $bar = $this->command->getOutput()->createProgressBar(100);
        foreach ($jobs as $department_id => $job_id) {
            $attributes = [
                'customer_id' => $customer_ids[$department_id],
                'job_id' => $job_id,
                'status' => $faker->numberBetween(0, 2)
            ];

            Project::create($attributes);

            $bar->advance();
        }
        $bar->finish();
        $this->command->comment(PHP_EOL.'生成完成！');
    }
}
