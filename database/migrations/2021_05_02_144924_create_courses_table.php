<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use saeid\Course\Model\Course;

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
            $table->unsignedBigInteger('teacher_id');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('banner_id')->nullable();
            $table->string('title');
            $table->string('slug');
            $table->string('price',10);
            $table->string('percent',5);
            $table->float('priority')->nullable();
            $table->enum('type',Course::$types);
            $table->enum('status',Course::$statuses);
            $table->enum('confirmation_status',Course::$confirmationStatuses);
            $table->text('body')->nullable();

            $table->foreign('teacher_id')->references('id')->on('users')->onDelete('CASCADE');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('SET NULL');
            $table->foreign('banner_id')->references('id')->on('media')->onDelete('SET NULL');
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
