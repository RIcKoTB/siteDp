<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiplomaLinksTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('diploma_links', function (Blueprint $table) {
            $table->id();
            // зробили типовий збіг із diploma_topics.id (BIGINT UNSIGNED)
            $table->unsignedBigInteger('topic_id');
            $table->string('link_text', 100);
            $table->string('url', 255);
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
        Schema::dropIfExists('diploma_links');
    }
}
