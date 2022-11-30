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
        Schema::create('users2', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('remember_token');
            $table->string('emaiil');
            $table->string('password');
            $table->string('name');
            $table->string('roles');
            $table->string('address');
            $table->string('phone');
            $table->string('avatar');
            $table->enum('status', ['ACTIVE','INCATIVE']);
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
        Schema::dropIfExists('users2');
    }
};
