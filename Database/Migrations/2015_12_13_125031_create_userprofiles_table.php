<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user__userprofiles', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('user_id');

            $table->text('description')->nullable();
            $table->text('office')->nullable();

            $table->text('bio')->nullable();

            $table->text('street')->nullable();
            $table->text('city')->nullable();
            $table->text('zip')->nullable();
            $table->text('country')->nullable();

            $table->string('phone')->nullable();
            $table->string('mobile')->nullable();


            $table->timestamps();

            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user__userprofiles');
    }
}
