<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogisticItemTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('logistic_item', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('logistic_id');
            $table->string('location', 30);
            $table->string('context', 100);
            $table->timestamp('created_at')->nullable();
            $table->index('logistic_id');
            $table->foreign('logistic_id')->references('id')->on('logistic_info')
                    ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('logistic_item');
    }

}
