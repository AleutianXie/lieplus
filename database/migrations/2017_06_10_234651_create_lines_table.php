<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLinesTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        //
        Schema::create('lines', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sn', 21)->unique();
            $table->unsignedInteger('cid');
            $table->foreign('cid')->references('id')->on('customers');
            $table->unsignedInteger('exclusive')->nullable();
            $table->foreign('exclusive')->references('id')->on('users');
            $table->enum('priority', ['1' => '普通', '2' => '紧急']);
            $table->unsignedInteger('jid');
            $table->foreign('jid')->references('id')->on('jobs');
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
    public function down() {
        //
        Schema::dropIfExists('lines');
    }
}
