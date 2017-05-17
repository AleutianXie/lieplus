<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sn', 20)->unique();
            $table->unsignedInteger('jid');
            $table->foreign('jid')->references('id')->on('jobs');
            $table->unsignedInteger('cid');
            $table->foreign('cid')->references('id')->on('customers');
            $table->boolean('show')->default(1);
            $table->enum('status', ['未审核','通过','拒绝'])->default('未审核');
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
    }
}
