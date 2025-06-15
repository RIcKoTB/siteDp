<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseRequirementsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('course_requirements', function (Blueprint $table) {
            $table->id();
            // Замінили integer->unsignedInteger на unsignedBigInteger
            $table->unsignedBigInteger('topic_id');
            $table->string('requirement', 100);
            $table->timestamps();

            // FK на course_topics.id (BIGINT UNSIGNED)
            $table->foreign('topic_id')
                ->references('id')
                ->on('course_topics')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_requirements');
    }
}
