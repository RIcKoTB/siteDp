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
        // Перевіряємо, чи існує таблиця practical_topics
        if (!Schema::hasTable('practical_topics')) {
            Schema::create('practical_topics', function (Blueprint $table) {
                $table->id();
                $table->foreignId('category_id')->constrained('practical_categories')->onDelete('cascade');
                $table->foreignId('teacher_id')->nullable()->constrained('users')->onDelete('set null');
                $table->string('title');
                $table->text('description')->nullable();
                $table->string('teacher')->nullable();
                $table->integer('hours')->nullable();
                $table->boolean('is_active')->default(true);
                
                // Додаткові поля для керівника
                $table->string('supervisor_name')->nullable();
                $table->string('supervisor_position')->nullable();
                $table->string('supervisor_email')->nullable();
                $table->string('supervisor_phone')->nullable();
                $table->text('supervisor_bio')->nullable();
                
                // JSON поля
                $table->json('stages')->nullable();
                $table->json('resources')->nullable();
                $table->text('requirements')->nullable();
                $table->json('consultations')->nullable();
                
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('practical_topics');
    }
};
