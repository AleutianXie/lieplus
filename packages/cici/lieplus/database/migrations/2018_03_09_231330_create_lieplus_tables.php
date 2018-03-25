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
            $table->unsignedTinyInteger('welfare')->default(0);
            $table->unsignedTinyInteger('work_time')->default(0);
            $table->string('founder', 30)->nullable();
            $table->unsignedTinyInteger('financing')->default(0);
            $table->unsignedTinyInteger('industry')->default(0);
            $table->unsignedTinyInteger('ranking')->default(0);
            $table->unsignedTinyInteger('property')->default(0);
            $table->unsignedTinyInteger('size')->default(0);
            $table->binary('introduce');
            $table->unsignedTinyInteger('level')->default(0);
            $table->unsignedTinyInteger('type')->default(0);
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
            $table->unsignedInteger('level')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });

        // departments table
        Schema::create('departments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('customer_id');
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->string('name', 60);
            $table->unsignedInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users');
            $table->unsignedInteger('updated_by');
            $table->foreign('updated_by')->references('id')->on('users');
            $table->timestamps();
            $table->softDeletes();
            // $table->unique(['customer_id', 'name']);
        });

        // jobs table
        Schema::create('jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('department_id');
            $table->foreign('department_id')->references('id')->on('departments');
            $table->string('name', 60);
            $table->binary('requirement');
            $table->unsignedTinyInteger('work_years')->default(0);
            $table->unsignedTinyInteger('gender')->default(0);
            $table->unsignedTinyInteger('majors')->default(0);
            $table->unsignedTinyInteger('degree')->default(0);
            $table->boolean('unified')->default(0);
            $table->binary('salary');
            $table->unsignedTinyInteger('property')->default(0);
            $table->boolean('closed')->default(0);
            $table->unsignedInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users');
            $table->unsignedInteger('updated_by');
            $table->foreign('updated_by')->references('id')->on('users');
            $table->timestamps();
            $table->softDeletes();
            // $table->unique(['did', 'name']);
        });

        // projects table
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('job_id');
            $table->foreign('job_id')->references('id')->on('jobs');
            $table->unsignedTinyInteger('status')->default(0);
            $table->unsignedInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users');
            $table->unsignedInteger('updated_by');
            $table->foreign('updated_by')->references('id')->on('users');
            $table->timestamps();
            $table->softDeletes();
        });

        // lines table
        Schema::create('lines', function (Blueprint $table) {
            $table->increments('id');
            // todo: 指定流水线，专属流水线，普通流水线，
            $table->unsignedInteger('exclusive')->nullable();
            $table->foreign('exclusive')->references('id')->on('users');
            $table->enum('priority', ['1' => '普通', '2' => '紧急']);
            $table->unsignedInteger('job_id');
            $table->foreign('job_id')->references('id')->on('jobs');
            $table->unsignedInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users');
            $table->unsignedInteger('updated_by');
            $table->foreign('updated_by')->references('id')->on('users');
            $table->timestamps();
            $table->softDeletes();
        });

        // stations table
        Schema::create('stations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('line_id');
            $table->foreign('line_id')->references('id')->on('lines');
            $table->unsignedInteger('resume_id');
            $table->foreign('resume_id')->references('id')->on('resumes');
            $table->unsignedTinyInteger('status')->default(0);
            $table->unsignedInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users');
            $table->unsignedInteger('updated_by');
            $table->foreign('updated_by')->references('id')->on('users');
            $table->timestamps();
            $table->softDeletes();
        });

        // user_has_lines table
        Schema::create('user_has_lines', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedInteger('line_id');
            $table->foreign('line_id')->references('id')->on('lines');
            $table->unsignedInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users');
            $table->unsignedInteger('updated_by');
            $table->foreign('updated_by')->references('id')->on('users');
            $table->timestamps();
            $table->softDeletes();
        });

        // user_has_customers table
        Schema::create('user_has_customers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedInteger('customer_id')->unique();
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->unsignedInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users');
            $table->unsignedInteger('updated_by');
            $table->foreign('updated_by')->references('id')->on('users');
            $table->timestamps();
            $table->softDeletes();
        });

        // branches table
        Schema::create('branches', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 60);
            $table->binary('description')->nullable();
            $table->unsignedInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users');
            $table->unsignedInteger('updated_by');
            $table->foreign('updated_by')->references('id')->on('users');
            $table->timestamps();
            $table->softDeletes();
        });

        // profiles table
        Schema::create('profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('number', 11)->nullable();
            $table->string('avatar', 60)->nullable();
            $table->string('birthdate', 10)->nullable();
            $table->tinyInteger('gender')->default(0);
            $table->string('mobile', 11)->nullable();
            $table->unsignedInteger('branch_id')->nullable();
            $table->foreign('branch_id')->references('id')->on('branches');
            $table->unsignedInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users');
            $table->unsignedInteger('updated_by');
            $table->foreign('updated_by')->references('id')->on('users');
            $table->timestamps();
            $table->softDeletes();
        });

        // plans table
        Schema::create('plans', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('line_id');
            $table->foreign('line_id')->references('id')->on('lines');
            $table->unsignedInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users');
            $table->unsignedInteger('updated_by');
            $table->foreign('updated_by')->references('id')->on('users');
            $table->timestamps();
            $table->softDeletes();
        });

        // user_has_resumes table
        Schema::create('user_has_resumes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedInteger('resume_id');
            $table->foreign('resume_id')->references('id')->on('resumes');
            $table->unsignedInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users');
            $table->unsignedInteger('updated_by');
            $table->foreign('updated_by')->references('id')->on('users');
            $table->timestamps();
            $table->softDeletes();
        });

        // user_has_jobs table
        Schema::create('user_has_jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedInteger('job_id');
            $table->foreign('job_id')->references('id')->on('jobs');
            $table->unsignedInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users');
            $table->unsignedInteger('updated_by');
            $table->foreign('updated_by')->references('id')->on('users');
            $table->timestamps();
            $table->softDeletes();
        });

        // job_has_resumes table
        Schema::create('job_has_resumes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('job_id');
            $table->foreign('job_id')->references('id')->on('jobs');
            $table->unsignedInteger('resume_id');
            $table->foreign('resume_id')->references('id')->on('resumes');
            $table->unsignedInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users');
            $table->unsignedInteger('updated_by');
            $table->foreign('updated_by')->references('id')->on('users');
            $table->timestamps();
            $table->softDeletes();
        });

        // todo: 提醒（分成三类提醒，工作台提醒、自我提醒、面试提醒）
//        //
//        Schema::create('alerts', function (Blueprint $table) {
//            $table->increments('id');
//            $table->unsignedInteger('rid');
//            $table->foreign('rid')->references('id')->on('resumes');
//            $table->enum('type', ['候选人电话',
//                '联系中',
//                '意向中',
//                '推荐中',
//                '面试中',
//                'offer中',
//                '入职中',
//                '试用期结束',
//                '预计到款',
//                '其他']);
//            $table->datetime('alert_at');
//            $table->mediumText('description');
//            $table->unsignedInteger('operator');
//            $table->foreign('operator')->references('id')->on('users');
//            $table->boolean('enabled')->default(1);
//            $table->boolean('show')->default(1);
//            $table->unsignedInteger('creater');
//            $table->foreign('creater')->references('id')->on('users');
//            $table->unsignedInteger('modifier');
//            $table->foreign('modifier')->references('id')->on('users');
//            $table->timestamps();
//        });
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
        Schema::dropIfExists('regions');
        Schema::dropIfExists('departments');
        Schema::dropIfExists('jobs');
        Schema::dropIfExists('projects');
        Schema::dropIfExists('lines');
        Schema::dropIfExists('stations');
        Schema::dropIfExists('user_has_lines');
        Schema::dropIfExists('user_has_customers');
        Schema::dropIfExists('branches');
        Schema::dropIfExists('profiles');
        Schema::dropIfExists('plans');
        Schema::dropIfExists('user_has_resumes');
        Schema::dropIfExists('user_has_jobs');
        Schema::dropIfExists('job_has_resumes');
    }
}
