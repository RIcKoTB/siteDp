<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiplomaTopicsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('diploma_topics', function (Blueprint $table) {
            // Заміна integer('id')->primary() на id() (BIGINT UNSIGNED AUTO_INCREMENT)
            $table->id();
            $table->string('title', 255);
            $table->text('description');
            $table->string('supervisor', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diploma_topics');
    }
}
