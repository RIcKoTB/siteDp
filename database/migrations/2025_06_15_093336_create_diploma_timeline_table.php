<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiplomaTimelineTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('diploma_timeline', function (Blueprint $table) {
            $table->id();
            // Змінено на unsignedBigInteger, щоб співпадав з diploma_topics.id
            $table->unsignedBigInteger('topic_id');
            $table->integer('step_order');
            $table->date('date');
            $table->string('description', 255);
            $table->timestamps();

            $table->foreign('topic_id')
                ->references('id')
                ->on('diploma_topics')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diploma_timeline');
    }
}
