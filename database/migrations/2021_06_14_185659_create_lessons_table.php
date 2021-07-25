<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use saeid\Course\Model\Lesson;

class CreateLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_id');
            $table->unsignedBigInteger('season_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('media_id')->nullable();
            $table->string('title');
            $table->string('slug');
            $table->integer('number')->unsigned()->nullable();
            $table->integer('time')->unsigned()->nullable();
            $table->boolean('is_free')->default(false);
            $table->enum('confirmation_status',Lesson::$confirmation_statuses)->default(Lesson::CONFIRMATION_STATUS_PENDING);
            $table->enum('status',Lesson::$statuses)->default(Lesson::STATUS_OPENED);
            $table->longText('body')->nullable();
            $table->timestamps();

            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->foreign('season_id')->references('id')->on('seasons')->onDelete('SET NUll');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('media_id')->references('id')->on('media')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lessons');
    }
}
