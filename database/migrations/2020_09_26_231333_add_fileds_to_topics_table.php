<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFiledsToTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('topics', function (Blueprint $table) {
            //
            $table->text('body');
            $table->unsignedBigInteger('user_id')->unsigned()->index();
            $table->integer('category_id')->unsigned()->index();
            $table->unsignedBigInteger('reply_count')->unsigned()->default(0);
            $table->integer('view_count')->unsigned()->default(0);
            $table->integer('last_reply_user_id')->unsigned()->default(0);
            $table->integer('order')->unsigned()->default(0);;
            $table->text('excerpt')->nullable();
            $table->string('slug')->nullable();;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('topics', function (Blueprint $table) {
            //
            $table->dropColumn('body');
            $table->dropColumn('user_id');
            $table->dropColumn('category_id');
            $table->dropColumn('view_count');
            $table->dropColumn('last_reply_user_id');
            $table->dropColumn('excerpt');
            $table->dropColumn('slug');
        });
    }
}
