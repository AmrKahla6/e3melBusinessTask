<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->integer('rating')->nullable();
            $table->integer('views')->nullable();
            $table->enum('levels', ['beginner', 'immediat','high']);
            $table->integer('hours')->nullable();
             //if 0 show else hide
             $table->boolean('active')->nullable();
             $table->string('image')->nullable();
             $table->bigInteger('cat_id')->unsigned()->nullable();
             $table->foreign('cat_id')->references('id')->on('categories')->onDelete('cascade');
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
        Schema::dropIfExists('courses');
    }
}
