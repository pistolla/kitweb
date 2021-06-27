<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublisherTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publishers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('username')->unique();
            $table->string('password');
            $table->string('country');
            $table->string('city');
            $table->string('mobile');
            $table->integer('tauth');
            $table->integer('tfver')->default(1);
            $table->integer('emailv');
            $table->integer('smsv');
            $table->integer('refer')->default(0);
            $table->string('balance')->nullable();
            $table->integer('status')->default(1);
            $table->string('vsent')->nullable();
            $table->string('vercode')->nullable();
            $table->string('secretcode')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('publishers');
    }
}
