<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Topic::class, function (Faker $faker) {
    $sentence = $faker->sentence;
    /*随机取一个月内的时间*/
    $update_at = $faker->dateTimeThisMonth();
    /*为创建时间传参，创建时间永远比更改时间找*/
    $create_at = $faker->dateTimeThisMonth($update_at);


    return [
        'title'=>$sentence,
        'body'=>$faker->text(),
        'excerpt'=>$sentence,
        'user_id'=>$faker->randomElement([1,2,3,4,5,6,7,8,9,10]),
        'category_id'=>$faker->randomElement([1,2,3,4]),
        'created_at'=>$create_at,
        'updated_at'=>$update_at
    ];
});
