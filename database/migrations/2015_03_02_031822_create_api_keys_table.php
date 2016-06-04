<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateApiKeysTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('api_key', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('key', 40);
            $table->smallInteger('level');
            $table->boolean('ignore_limits');
            $table->nullableTimestamps();
            $table->softDeletes();

            // unique key
            $table->unique('key');

            // Let's index the user ID just in case you don't set it as a foreign key
            $table->index('user_id');
            $table->foreign('user_id')->references('id')->on('admin');

            // Uncomment the line below if you want to link user ids to your users table
            //$table->foreign('user_id')->references('id')->on('users')->onDelete('set null');;
        });

        Schema::create('api_log', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('api_key_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('route', 255);
            $table->string('method', 6);
            $table->text('params');
            $table->string('ip_address');
            $table->nullableTimestamps();


            $table->index('route');
            $table->index('method');

            // Let's index the user ID just in case you don't set it as a foreign key
            $table->index('user_id');
            $table->index('api_key_id');
            
            $table->foreign('api_key_id')->references('id')->on('api_key');
            $table->foreign('user_id')->references('id')->on('admin');
            // Uncomment the line below if you want to link user ids to your users table
            //$table->foreign('user_id')->references('id')->on('users')->onDelete('set null');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('api_keys', function (Blueprint $table) {
            //$table->dropForeign('api_keys_user_id_foreign');
        });

        Schema::table('api_logs', function (Blueprint $table) {
            $table->dropForeign('api_logs_api_key_id_foreign');
        });

        Schema::drop('api_keys');
        Schema::drop('api_logs');
    }

}
