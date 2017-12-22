<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $users = factory(User::class)->times(20)->make();
        User::insert($users->makeVisible(['password', 'remember_token'])->toArray());
        // 单独处理第一个用户的数据
        $user = User::find(1);
        $user->name = 'Admin';
        $user->email = 'admin@admin.com';
        $user->save();
        $user->assignRole('Administrator');
    }
}
