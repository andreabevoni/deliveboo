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
            $table->id();
            $table->string('restaurant_name', 100);
            $table->string('password');
            $table->string('address', 100);
            $table->string('password');
            $table->string('p_iva', 11);
            $table->string('password');
            $table->string('phone', 60)->nullable();
            $table->string('email', 100)->unique();
            $table->string('image')->nullable();
            $table->tinyInteger('closing_day')->nullable();
            $table->time('opening_time')->nullable();
            $table->time('closing_time')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        // test
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
