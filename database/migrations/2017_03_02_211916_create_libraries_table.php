<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLibrariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('libraries', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('uid');
            $table->foreign('uid')->references('id')->on('users');
            $table->unsignedInteger('rid');
            $table->foreign('rid')->references('id')->on('resumes');
            $table->enum('type', ['1' => 'my', '2' => 'job', ]);
            $table->boolean('show')->default(1);
            $table->unsignedInteger('creater');
            $table->foreign('creater')->references('id')->on('users');
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
        Schema::dropIfExists('libraries');
    }
}
