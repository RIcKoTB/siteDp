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
        Schema::create('educational_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Назва категорії
            $table->string('slug')->unique(); // URL slug
            $table->text('description')->nullable(); // Опис категорії
            $table->string('color')->default('#3498db'); // Колір категорії
            $table->string('icon')->nullable(); // Іконка категорії
            $table->boolean('is_active')->default(true); // Активна категорія
            $table->integer('sort_order')->default(0); // Порядок сортування
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('educational_categories');
    }
};
