<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('jobs', function (Blueprint $table)
        {
            $table->increments('id');
            $table->string('sn', 20)->unique();
            $table->unsignedInteger('cid');
            $table->foreign('cid')->references('id')->on('customers');
            $table->unsignedInteger('did');
            $table->foreign('did')->references('id')->on('departments');
            $table->string('name', 60);
            $table->binary('requirement');
            $table->enum('workyears', ['1' => '三年以下', '2' => '三年以上', '3' => '五年以上', '4' => '八年以上', '5' => '十年以上', '6' => '二十年以上']);
            $table->enum('gender', ['1' => '男', '2' => '女']);
            $table->enum('majors', ['1' => '计算机相关', '2' => '会计相关', '3' => '金融相关', '4' => '专业相关', '5' => '其他']);
            $table->enum('degree', ['1' => '大专', '2' => '本科', '3' => '研究生', '4' => '博士']);
            $table->boolean('unified')->default(0);
            $table->binary('salary');
            $table->enum('property', ['1' => '普通职位', '2' => '指定职位', '3' => '专属职位']);
            $table->boolean('show')->default(1);
            $table->boolean('closed')->default(0);
            $table->unsignedInteger('creater');
            $table->foreign('creater')->references('id')->on('users');
            $table->unsignedInteger('modifier');
            $table->foreign('modifier')->references('id')->on('users');
            $table->timestamps();
            $table->unique(['did', 'name']);

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
        Schema::dropIfExists('jobs');
    }
}
