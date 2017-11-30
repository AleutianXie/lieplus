<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('stations', function (Blueprint $table)
        {
            $table->increments('id');
            $table->string('sn', 21)->unique();
            $table->unsignedInteger('lid');
            $table->foreign('lid')->references('id')->on('lines');
            $table->unsignedInteger('rid');
            $table->foreign('rid')->references('id')->on('resumes');
            $table->enum('status', [
                '1' => '联系中',
                '2' => '意向中',
                '3' => '审批中',
                '4' => '推荐中',
                '5' => '面试中',
                '6' => 'offer中',
                '7' => '入职中']);
            $table->boolean('show')->default(1);
            $table->boolean('disable')->default(0);
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
        Schema::dropIfExists('stations');
    }
}
