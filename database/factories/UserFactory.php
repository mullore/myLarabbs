<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/
$avatars= [
    'https://mullore.oss-cn-beijing.aliyuncs.com/20190422140657_jdQYJ.jpeg',
    'https://mullore.oss-cn-beijing.aliyuncs.com/20200510054256_uweyg.jpg',
    'https://mullore.oss-cn-beijing.aliyuncs.com/3e2d41ec2e738bd4868a505fb68b87d6267ff954.jpg',
    'https://mullore.oss-cn-beijing.aliyuncs.com/20181231085130_jphdb.jpg',
    'https://mullore.oss-cn-beijing.aliyuncs.com/e51bc7bf6c81800a64b65ebcbf3533fa838b47f0.jpg',
    // 'https://cdn.learnku.com/uploads/images/201710/14/1/NDnzMutoxX.png',
];

$factory->define(User::class, function (Faker $faker) use ($avatars) {
    $data_time = $faker->date().''.$faker->time();
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'avatar'=> $faker->randomElement($avatars),
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
        'introduction'=> $faker->sentence(),
        'created_at'=> $data_time,
        'updated_at' => $data_time
    ];
});
