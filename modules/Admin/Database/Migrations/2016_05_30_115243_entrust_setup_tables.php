<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class EntrustSetupTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {
        // Create table for storing roles
        Schema::create('role', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',30)->unique();
            $table->string('description',50)->nullable();
            $table->timestamps();
        });

        // Create table for associating roles to users (Many-to-Many)
        Schema::create('role_admin', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('admin_id')->unsigned();
            $table->unsignedBigInteger('role_id')->unsigned();

            $table->foreign('admin_id')->references('id')->on('admin')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('role')
                ->onUpdate('cascade')->onDelete('cascade');
        });

        // Create table for storing permissions
        Schema::create('permission', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',30)->unique();
            $table->string('description',50)->nullable();
            $table->timestamps();
        });

        // Create table for associating permissions to roles (Many-to-Many)
        Schema::create('permission_role', function (Blueprint $table) {
            
            $table->bigIncrements('id');
            
            $table->unsignedBigInteger('permission_id')->unsigned();
            $table->unsignedBigInteger('role_id')->unsigned();

            $table->foreign('permission_id')->references('id')->on('permission')
                ->onUpdate('cascade')->onDelete('cascade');
            
            $table->foreign('role_id')->references('id')->on('role')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return  void
     */
    public function down()
    {
        Schema::drop('permission_role');
        Schema::drop('permission');
        Schema::drop('role_admin');
        Schema::drop('role');
    }
}
