<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('regions', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->char('code', 6)->unique();
            $table->string('name', 40);
            $table->char('parent', 6)->index()->nullable();
            $table->enum('type', ['1' => '省', '2' => '市', '3' => '县']);
            $table->boolean('show')->default(1);
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
        Schema::dropIfExists('regions');

    }
}
