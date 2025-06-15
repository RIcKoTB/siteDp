<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePracticeModulesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('practice_modules', function (Blueprint $table) {
            $table->id();
            $table->enum('module_type', ['lab', 'project', 'internship']);
            $table->string('title', 255);
            $table->text('description');
            $table->string('resource_url', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('practice_modules');
    }
}
