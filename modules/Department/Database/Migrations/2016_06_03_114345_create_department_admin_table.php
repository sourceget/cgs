<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartmentAdminTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('department_admin', function(Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('admin_id')->unsigned();
            $table->unsignedBigInteger('department_id')->unsigned();

            $table->foreign('admin_id')->references('id')->on('admin')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('department_id')->references('id')->on('department')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('department_admin');
    }

}
