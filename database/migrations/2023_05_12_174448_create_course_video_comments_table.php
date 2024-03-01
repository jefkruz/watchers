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
        Schema::create('course_video_comments', function (Blueprint $table) {
            $table->id();
            $table->integer('course_id');
            $table->integer('video_id');
            $table->integer('user_id');
            $table->string('name');
            $table->string('picture');
            $table->text('comment');
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
        Schema::dropIfExists('course_video_comments');
    }
};
