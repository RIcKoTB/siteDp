<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Видаляємо зайві таблиці
        Schema::dropIfExists('practical_requirements');
        Schema::dropIfExists('practical_timelines');
        Schema::dropIfExists('practical_links');
        Schema::dropIfExists('practical_approveds');
        Schema::dropIfExists('practical_consultations');
        Schema::dropIfExists('practical_applications');
        Schema::dropIfExists('practical_topic_supervisors');
        Schema::dropIfExists('practical_topic_stages');
        Schema::dropIfExists('practical_topic_resources');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
