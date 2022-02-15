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
            $table->string('name');
            $table->string('username')->unique();
            $table->integer('type');
            $table->integer('status')->default(1);
            $table->string('email')->unique();
            $table->string('gender')->nullable();
            $table->string('image')->nullable();
            $table->string('job_title')->nullable();
            $table->bigInteger('phone')->nullable();
            $table->string('website')->nullable();
            $table->string('birthday')->nullable();
            $table->string('experience')->nullable();
            $table->string('education')->nullable();
            $table->integer('category_id')->nullable();
            $table->text('languages')->nullable();
            $table->text('skills')->nullable();
            $table->string('cv')->nullable();
            $table->text('description')->nullable();
            $table->integer('country_id')->nullable();
            $table->integer('city_id')->nullable();
            $table->string('address')->nullable();
            $table->string('zip')->nullable();
            $table->text('facebook')->nullable();
            $table->text('twitter')->nullable();
            $table->text('linkedin')->nullable();
            $table->text('instagram')->nullable();
            $table->string('company_email')->nullable();
            $table->integer('founded_in')->nullable();
            $table->string('company_type')->nullable();
            $table->string('company_size')->nullable();
            $table->string('b_name')->nullable();
            $table->string('b_email')->nullable();
            $table->string('cover')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
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
        Schema::dropIfExists('users');
    }
}
