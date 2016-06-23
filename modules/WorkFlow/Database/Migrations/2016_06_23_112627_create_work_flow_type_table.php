<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkFlowTypeTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

        Schema::create('work_flow_type', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code', 30)->comment('唯一编码');
            $table->string('name', 50)->comment('名称');
            $table->unique('code');
            $table->comment = '流程分类';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('work_flow_type');
    }

}
