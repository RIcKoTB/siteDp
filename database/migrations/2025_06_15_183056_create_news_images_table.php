<?php

// database/migrations/xxxx_xx_xx_xxxxxx_create_news_images_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('news_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('news_id')->constrained()->onDelete('cascade');
            $table->string('path'); // шлях до зображення
            $table->string('caption')->nullable(); // підпис до зображення
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('news_images');
    }
};
