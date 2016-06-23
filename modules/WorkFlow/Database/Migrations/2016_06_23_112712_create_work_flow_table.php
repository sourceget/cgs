<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkFlowTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('work_flow', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('type_id')->unsigned();
            $table->string('code', 30)->comment('唯一编码');
            $table->string('name');
            $table->string('conditions',255)->comment('条件');
            $table->index('type_id');
            $table->unique('code');
            
            $table->foreign('type_id')->references('id')->on('work_flow_type')
                    ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('work_flow');
    }

}
