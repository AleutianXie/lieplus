<?php

use App\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        echo "Create Role admin.\n";
        Role::create(['name' => 'admin']);
        echo "Create Role manager.\n";
        Role::create(['name' => 'manager']);
        echo "Create Role bd.\n";
        Role::create(['name' => 'bd']);
        echo "Create Role recruiter.\n";
        Role::create(['name' => 'recruiter']);
        echo "Create Role customer.\n";
        Role::create(['name' => 'customer']);
        echo "Assign Role admin to Adminstrator.\n";
        $user = User::where(['name' => 'Aleutian Xie'])->first();
        $user->assignRole('admin');
        echo "OK!\n";
    }
}
