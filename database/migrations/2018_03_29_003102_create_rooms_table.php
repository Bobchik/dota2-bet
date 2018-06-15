<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->bigInteger('id');
            $table->string('rank');
            $table->double('bank')->default(0);
            $table->double('min_bet');
            $table->double('max_bet');
            $table->text('players');
            $table->integer('winners')->default(0);
        });

        Schema::table('rooms', function (Blueprint $table) {
           $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rooms');
    }
}
