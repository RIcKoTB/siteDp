<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiplomaRequirementsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('diploma_requirements', function (Blueprint $table) {
            $table->id();

            // використовуємо unsignedBigInteger, щоб тип збігався з diploma_topics.id
            $table->unsignedBigInteger('topic_id');

            $table->string('requirement', 100);
            $table->timestamps();

            // зовнішній ключ до diploma_topics.id (BIGINT UNSIGNED)
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
        Schema::dropIfExists('diploma_requirements');
    }
}
