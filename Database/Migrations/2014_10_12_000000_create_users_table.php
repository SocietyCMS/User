<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user__users', function (Blueprint $table) {
            $table->increments('id');

            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();

            $table->string('email')->unique();

            $table->string('title')->nullable();

            $table->text('office')->nullable();

            $table->text('bio')->nullable();

            $table->text('street')->nullable();
            $table->text('city')->nullable();
            $table->text('zip')->nullable();
            $table->text('country')->nullable();

            $table->string('phone')->nullable();
            $table->string('mobile')->nullable();

            $table->string('password');
            $table->timestamp('last_login');

            $table->softDeletes();
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
        Schema::drop('user__users');
    }
}
