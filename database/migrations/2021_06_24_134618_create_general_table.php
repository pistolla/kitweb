<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneralTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('generals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->default('Website');
            $table->string('subtitle')->default('Sub Title');
            $table->string('color')->default('336699');
            $table->string('cur')->default('USD');
            $table->string('cursym')->default('$');
            $table->integer('reg')->default('1');
            $table->integer('emailver')->default('1');
            $table->integer('smsver')->default('1');
            $table->integer('decimal')->default('2');
            $table->integer('emailnotf')->default('1');
            $table->integer('smsnotf')->default('1');
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
        Schema::dropIfExists('generals');
    }
}
