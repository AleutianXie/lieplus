<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('roles')->insert([
            'id' => 1,
            'name' => '管理员',
            'creater' => 1,
            'modifier' => 1,
            'created_at' => date('Y-m-d H:i:s', time()),
            'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('roles')->insert([
            'id' => 2,
            'name' => '部门经理',
            'creater' => 1,
            'modifier' => 1,
            'created_at' => date('Y-m-d H:i:s', time()),
            'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('roles')->insert([
            'id' => 3,
            'name' => 'BD',
            'creater' => 1,
            'modifier' => 1,
            'created_at' => date('Y-m-d H:i:s', time()),
            'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('roles')->insert([
            'id' => 4,
            'name' => '招聘经理',
            'creater' => 1,
            'modifier' => 1,
            'created_at' => date('Y-m-d H:i:s', time()),
            'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('roles')->insert([
            'id' => 5,
            'name' => '客户顾问',
            'creater' => 1,
            'modifier' => 1,
            'created_at' => date('Y-m-d H:i:s', time()),
            'updated_at' => date('Y-m-d H:i:s', time())]);
    }
}
