<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepliesTable extends Migration
{
	public function up()
	{
		Schema::create('replies', function(Blueprint $table) {
            $table->Increments('id');
            $table->unsignedBigInteger('topic_id')->unsigned()->default(0)->index();
            $table->unsignedBigInteger('user_id')->unsigned()->default(0)->index();
            $table->text('content')->nullable();
            $table->timestamps();
        });
	}

	public function down()
	{
		Schema::drop('replies');
	}
}
