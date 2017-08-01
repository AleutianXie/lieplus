<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreareDepartmentsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		//
		Schema::create('departments', function (Blueprint $table) {
			$table->increments('id');
			$table->unsignedInteger('cid');
			$table->foreign('cid')->references('id')->on('customers');
			$table->string('name', 60);
			$table->boolean('show')->default(1);
			$table->unsignedInteger('creater');
			$table->foreign('creater')->references('id')->on('users');
			$table->unsignedInteger('modifier');
			$table->foreign('modifier')->references('id')->on('users');
			$table->timestamps();
			$table->unique(['cid', 'name']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		//
		Schema::dropIfExists('departments');
	}
}
