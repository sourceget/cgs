<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartmentTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('department', function(Blueprint $table)
        {
            $table->unsignedBigInteger('leader_id')->nullable()->after('id');
            $table->index('leader_id');
            $table->foreign('leader_id')->references('id')->on('admin')
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
        Schema::table('department', function(Blueprint $table)
        {
            $table->dropColumn('leader_id');
            $table->dropIndex('department_leader_id_index');
        });
    }

}
