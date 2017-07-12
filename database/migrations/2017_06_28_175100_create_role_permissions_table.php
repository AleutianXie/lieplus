<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('role_permissions', function (Blueprint $table)
        {
            $table->increments('id');
            $table->unsignedInteger('rid')->nullable();
            $table->foreign('rid')->references('id')->on('roles');
            $table->string('model', 30);
            $table->string('action', 30);
            $table->binary('description');
            $table->boolean('enabled')->default(0);
            $table->boolean('show')->default(1);
            $table->unsignedInteger('creater');
            $table->foreign('creater')->references('id')->on('users');
            $table->unsignedInteger('modifier');
            $table->foreign('modifier')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('role_permissions');
    }
}
