<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('title');
            $table->text('description');
            $table->integer('category_id');
            $table->integer('country_id')->nullable();
            $table->integer('city_id')->nullable();
            $table->string('type');
            $table->integer('hours')->nullable();
            $table->integer('salary')->nullable();
            $table->text('skills')->nullable();
            $table->string('gender');
            $table->integer('show_applicants_num')->default(0);
            $table->string('expire_date')->nullable();
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
        Schema::dropIfExists('jobs');
    }
}
