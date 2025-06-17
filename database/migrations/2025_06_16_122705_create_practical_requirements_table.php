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
        Schema::create('practical_requirements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('practical_categories')->onDelete('cascade');
            $table->foreignId('topic_id')->nullable()->constrained('practical_topics')->onDelete('cascade');
            $table->text('requirement');
            $table->enum('priority', ['low', 'medium', 'high'])->default('medium');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('practical_requirements');
    }
};
