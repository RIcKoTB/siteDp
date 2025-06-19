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
        Schema::table('survey_responses', function (Blueprint $table) {
            // Видаляємо старі колонки
            $table->dropForeign(['category_id']);
            $table->dropColumn(['category_id', 'rating', 'comment', 'submitted_at']);
            
            // Додаємо нові колонки
            $table->foreignId('survey_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->json('answers');
            $table->string('ip_address')->nullable();
            $table->text('user_agent')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('survey_responses', function (Blueprint $table) {
            // Повертаємо старі колонки
            $table->dropForeign(['survey_id']);
            $table->dropForeign(['user_id']);
            $table->dropColumn(['survey_id', 'user_id', 'answers', 'ip_address', 'user_agent']);
            
            $table->foreignId('category_id')->constrained('survey_categories')->onDelete('cascade');
            $table->tinyInteger('rating');
            $table->text('comment')->nullable();
            $table->timestamp('submitted_at')->nullable();
        });
    }
};
