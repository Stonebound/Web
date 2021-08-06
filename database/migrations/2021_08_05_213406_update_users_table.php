<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('slug')->nullable();
            $table->text('picture')->nullable();
            $table->boolean('picture_legacy')->default(false);
            $table->text('location')->nullable();
            $table->text('aboutme')->nullable();
            $table->string('birthday')->nullable();
            $table->string('website')->nullable();
            $table->text('signature')->nullable();
            $table->unsignedBigInteger('nodebb_uid')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
