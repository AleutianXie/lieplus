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
            $table->enum('type', ['候选人电话',
                '联系中',
                '意向中',
                '推荐中',
                '面试中',
                'offer中',
                '入职中',
                '试用期结束',
                '预计到款',
                '其他']);
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
