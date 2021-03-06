<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopicsTable extends Migration
{
	public function up()
	{
		Schema::create('topics', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
        });
	}

	public function down()
	{
		Schema::drop('topics');
	}
}
