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
        //工厂批量创建
        factory(\App\Models\User::class)->times(10)->create();

        /*执行填充时会对第一个用户进行修改*/
        // $user = User::find(1);
        // $user->name = "one";
        // $user->email = "mullore@qq.com";
        // $user->avatar = "https://cdn.learnku.com/uploads/images/201710/14/1/ZqM7iaP4CR.png";
        // $user->save();

    }
}
