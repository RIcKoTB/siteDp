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
        Schema::create('educational_components', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Назва предмету
            $table->string('code')->unique(); // Код предмету (наприклад, ІТ-101)
            $table->text('description'); // Опис предмету
            $table->text('objectives'); // Цілі та завдання
            $table->text('content'); // Зміст предмету (HTML)
            $table->json('learning_outcomes'); // Результати навчання (масив)
            $table->json('assessment_methods'); // Методи оцінювання (масив)
            $table->json('literature'); // Література (масив об'єктів)
            $table->string('category'); // Категорія (загальна підготовка, професійна, тощо)
            $table->integer('credits'); // Кількість кредитів
            $table->integer('hours_total'); // Загальна кількість годин
            $table->integer('hours_lectures'); // Години лекцій
            $table->integer('hours_practical'); // Години практичних
            $table->integer('hours_laboratory'); // Години лабораторних
            $table->integer('hours_independent'); // Години самостійної роботи
            $table->string('semester'); // Семестр вивчення
            $table->string('teacher_name')->nullable(); // Викладач
            $table->string('teacher_email')->nullable(); // Email викладача
            $table->string('image_url')->nullable(); // Зображення предмету
            $table->json('schedule')->nullable(); // Розклад занять
            $table->boolean('is_active')->default(true); // Активний предмет
            $table->integer('sort_order')->default(0); // Порядок сортування
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('educational_components');
    }
};
