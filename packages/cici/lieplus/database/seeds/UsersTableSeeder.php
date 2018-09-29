<?php

use App\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        $this->command->comment('插入全国省市县信息...');
//        $this->command->info('插入全国省市县信息...');
//        $this->command->question('插入全国省市县信息...');
//        $this->command->error('插入全国省市县信息...');

        $this->command->question('创建一个管理员用户...');
        $name = $this->command->ask('用户名:', "Aleutian Xie");
        $email = $this->command->ask('邮箱:', "aleutian.xie@cicisoft.cn");
        $password = $this->command->secret("密码:");
        $password = password_hash($password,PASSWORD_BCRYPT);
        $created_at = date('Y-m-d H:i:s', time());
        $updated_at = date('Y-m-d H:i:s', time());
        DB::table('users')->insert(compact('name', 'email', 'password', 'created_at', 'updated_at'));
        $this->command->info('创建管理员完成!');

        $this->command->comment('创建角色和分配管理员角色...');
        $this->command->comment("Create Role admin.");
        Role::create(['name' => 'admin']);
        $this->command->comment("Create Role manager.");
        Role::create(['name' => 'manager']);
        $this->command->comment("Create Role bd.");
        Role::create(['name' => 'bd']);
        $this->command->comment("Create Role recruiter.");
        Role::create(['name' => 'recruiter']);
        $this->command->comment("Create Role customer.");
        Role::create(['name' => 'customer']);
        $this->command->comment("Assign Role admin to $name.");
        $user = User::where(compact('name'))->first();
        $user->assignRole('admin');
        $this->command->info('创建角色和分配管理员角色完成!');
    }
}
