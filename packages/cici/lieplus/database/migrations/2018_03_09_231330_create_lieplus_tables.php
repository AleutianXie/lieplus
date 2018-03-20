<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLieplusTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // resumes table
        Schema::create('resumes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 30)->index();
            $table->string('mobile', 11)->unique();
            $table->string('email', 50)->unique();
            $table->tinyInteger('gender')->default(0);
            $table->string('birthdate', 10);
            $table->string('start_work_date', 10);
            $table->tinyInteger('degree')->default(1);
            $table->tinyInteger('service_status')->default(0);
            $table->char('province', 6)->index()->nullable();
            $table->char('city', 6)->index()->nullable();
            $table->char('county', 6)->index()->nullable();
            $table->string('position', 20);
            $table->string('industry', 20);
            $table->tinyInteger('salary')->default(0);
            $table->string('feedback')->nullable();
            $table->unsignedInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users');
            $table->unsignedInteger('updated_by');
            $table->foreign('updated_by')->references('id')->on('users');
            $table->timestamps();
            $table->softDeletes();
        });
        // once the table is created use a raw query to ALTER it and add the MEDIUMBLOB
        DB::statement("ALTER TABLE resumes ADD others LONGBLOB after salary");

        // feedbacks table
        Schema::create('feedbacks', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('resume_id');
            $table->foreign('resume_id')->references('id')->on('resumes');
            $table->string('text');
            $table->unsignedInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users');
            $table->timestamps();
            $table->softDeletes();
        });

        // customers table
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 60)->unique();
            $table->char('province', 6)->index()->nullable();
            $table->char('city', 6)->index()->nullable();
            $table->char('county', 6)->index()->nullable();
            $table->unsignedTinyInteger('welfare')->default('0');
            $table->unsignedTinyInteger('worktime')->default('0');
            $table->string('founder', 30)->nullable();
            $table->unsignedTinyInteger('financing')->default('0');
            $table->unsignedTinyInteger('industry')->default('0');
            $table->unsignedTinyInteger('ranking')->default('0');
            $table->unsignedTinyInteger('property')->default('0');
            $table->unsignedTinyInteger('size')->default('0');
            $table->binary('introduce');
            $table->unsignedTinyInteger('level')->default('0');
            $table->unsignedTinyInteger('type')->default('0');
            $table->boolean('status')->default(0);
            $table->unsignedInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users');
            $table->unsignedInteger('updated_by');
            $table->foreign('updated_by')->references('id')->on('users');
            $table->timestamps();
            $table->softDeletes();
        });

        // regions table
        Schema::create('regions', function (Blueprint $table) {
            $table->increments('id');
            $table->char('citycode', 6)->index();
            $table->char('adcode', 6)->index();
            $table->string('name', 60);
            $table->string('center', 30);
            $table->tinyInteger('level')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resumes');
        Schema::dropIfExists('feedbacks');
        Schema::dropIfExists('customers');
    }
}
