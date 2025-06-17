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
        Schema::create('practical_approveds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('practical_categories')->onDelete('cascade');
            $table->foreignId('topic_id')->constrained('practical_topics')->onDelete('cascade');
            $table->string('student_name');
            $table->string('student_email')->nullable();
            $table->string('supervisor');
            $table->enum('status', ['approved', 'in_progress', 'completed'])->default('approved');
            $table->date('approved_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('practical_approveds');
    }
};
