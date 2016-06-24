<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogisticInfoTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        
        Schema::create('logistic_info', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('logistic_id');
            $table->string('no', 30);
            $table->timestamp('updated_at')->nullable();
            $table->index('logistic_id');
            $table->foreign('logistic_id')->references('id')->on('logistic')
                    ->onUpdate('cascade')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('logistic_info');
    }

}
