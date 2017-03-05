<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlertsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('alerts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('rid');
            $table->foreign('rid')->references('id')->on('resumes');
            $table->enum('type', ['0' => '候选人电话',
                '1' => '联系中',
                '2' => '意向中',
                '3' => '推荐中',
                '4' => '面试中',
                '5' => 'offer中',
                '6' => '入职中',
                '7' => '试用期结束',
                '8' => '预计到款',
                '9' => '其他']);
            $table->datetime('alert_at');
            $table->mediumText('description');
            $table->unsignedInteger('operator');
            $table->foreign('operator')->references('id')->on('users');
            $table->boolean('enabled')->default(1);
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
        Schema::dropIfExists('alerts');
    }
}
