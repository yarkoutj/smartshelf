<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //id ubicacion pesovacio codigo
        Schema::create('shelfs', function (Blueprint $table) {
            $table->id();
            $table->string('shelf',3);
            $table->integer('level');
            $table->string('state',9);
            $table->string('shelf_id',3);
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
        Schema::dropIfExists('shelfs');
    }
};
