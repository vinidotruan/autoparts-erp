<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('user');
            $table->integer('cpf')->unique();
            $table->string('email')->unique();
            $table->boolean('active')->default(false);
            $table->string('activation_token');
            $table->unsignedBigInteger('role_id')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->foreign('role_id')->references('id')->on('roles');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
