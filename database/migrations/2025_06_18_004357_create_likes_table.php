<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('likes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('news_id')->constrained()->onDelete('cascade');
            $table->string('ip_address');
            $table->string('user_agent')->nullable();
            $table->timestamps();
            
            // Унікальний індекс щоб один IP не міг лайкнути двічі
            $table->unique(['news_id', 'ip_address']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('likes');
    }
};
