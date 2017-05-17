<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sn', 20)->unique();
            $table->string('name', 60)->unique();
            $table->char('province', 6)->index()->nullable();
            $table->char('city', 6)->index()->nullable();
            $table->char('county', 6)->index()->nullable();
            $table->enum('welfare', ['1' => '五险一金全额缴纳', '2' => '五险一金比例缴纳']);
            $table->enum('worktime', ['1' => '朝九晚六', '2' => '996', '3' =>'弹性时间', '4' => '其他']);
            $table->string('founder', 30)->nullable();
            $table->enum('financing', ['1' =>'a轮前', '2' => 'b轮', '3' => 'c轮', '4' => 'd轮', '5' => '上市公司', '6' => '不用融资']);
            $table->enum('industry',  ['1' => '互联网软件', '2' => '金融投资', '3' => '消费品', '4' => '能源', '5' => '医疗', '6' => '地产', '7' => '服务业', '8' => '传媒', '9' => '其他']);
            $table->enum('ranking', ['1' => '第一名', '2' => '前三名', '3' => '新创企业']);
            $table->enum('property', ['1' => '外商独资/外企办事处', '2' => '中外合营(合资/合作)', '3' => '私营/民营企业', '4' => '国有企业', '5' => '国内上市公司', '6' => '政府机关／非盈利机构', '7' => '事业单位', '8' => '其他']);
            $table->enum('size', ['1' => '1-49人', '2' => '50-99人', '3' => '100-499人', '4' => '500-999人', '5' => '1000-2000人', '6' => '2000-5000人', '7' => '5000-10000人', '8' => '10000人以上']);
            $table->binary('introduce');
            $table->enum('level', ['未设置', '1级', '2级', '3级'])->default('未设置');
            $table->enum('type', ['未设置', '未签约', '已签约', '有成交'])->default('未设置');
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
        Schema::dropIfExists('customers');
    }
}
