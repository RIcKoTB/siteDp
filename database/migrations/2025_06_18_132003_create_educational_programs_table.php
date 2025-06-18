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
        Schema::create('educational_programs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('code')->unique();
            $table->text('description');
            $table->text('objectives')->nullable();
            $table->json('competencies')->nullable();
            $table->json('learning_outcomes')->nullable();
            $table->text('admission_requirements')->nullable();
            $table->integer('duration_years')->default(4);
            $table->integer('credits_total')->default(240);
            $table->string('qualification')->nullable();
            $table->text('career_prospects')->nullable();
            $table->json('curriculum')->nullable();
            $table->string('image_url')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('educational_programs');
    }
};
