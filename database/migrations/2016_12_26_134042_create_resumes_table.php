<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResumesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('resumes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sn', 20)->unique();
            $table->string('name', 30)->index();
            $table->string('mobile', 11)->unique();
            $table->string('email', 50)->unique();
            $table->tinyInteger('gender')->default(0);
            $table->date('birthdate');
            $table->date('startworkdate');
            $table->tinyInteger('degree')->default(1);
            $table->tinyInteger('servicestatus')->default(0);
            $table->char('province', 6)->index()->nullable();
            $table->char('city', 6)->index()->nullable();
            $table->char('county', 6)->index()->nullable();
            $table->string('position', 20);
            $table->string('industry', 20);
            $table->tinyInteger('salary')->default(0);
            $table->string('feedback')->nullable();
            $table->boolean('show')->default(1);
            //$table->binary('others');
            $table->unsignedInteger('creater');
            $table->foreign('creater')->references('id')->on('users');
            $table->unsignedInteger('modifier');
            $table->foreign('modifier')->references('id')->on('users');
            $table->timestamps();
        });

        // once the table is created use a raw query to ALTER it and add the MEDIUMBLOB
        DB::statement("ALTER TABLE resumes ADD others LONGBLOB after salary");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resumes');
    }
}
