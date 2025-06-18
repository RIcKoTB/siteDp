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
        Schema::create('surveys', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->json('questions');
            $table->boolean('is_active')->default(true);
            $table->boolean('is_anonymous')->default(true);
            $table->datetime('start_date')->nullable();
            $table->datetime('end_date')->nullable();
            $table->string('target_audience')->nullable();
            $table->text('thank_you_message')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surveys');
    }
};
