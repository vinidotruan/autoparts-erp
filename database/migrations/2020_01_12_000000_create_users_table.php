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
            $table->unsignedBigInteger('cpf')->unique();
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

        // Admin default user
        DB::table('users')->insert(
            array(
                'name' => 'admin',
                'email' => 'admin@admin',
                'user' => 'admin',
                'active' => 1,
                'cpf' => 04037131021,
                'password' => Hash::make('password'),
                'role_id' => 1,
                'gender_id' => 1,
                'value' => 1
            )
        );
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
