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
        Schema::table('practical_topics', function (Blueprint $table) {
            // Додаємо поля для керівника
            $table->string('supervisor_name')->nullable()->after('teacher');
            $table->string('supervisor_position')->nullable()->after('supervisor_name');
            $table->string('supervisor_email')->nullable()->after('supervisor_position');
            $table->string('supervisor_phone')->nullable()->after('supervisor_email');
            $table->text('supervisor_bio')->nullable()->after('supervisor_phone');

            // Додаємо поля для етапів (JSON)
            $table->json('stages')->nullable()->after('supervisor_bio');

            // Додаємо поля для ресурсів (JSON)
            $table->json('resources')->nullable()->after('stages');

            // Додаємо поля для вимог
            $table->text('requirements')->nullable()->after('resources');

            // Додаємо поля для консультацій (JSON)
            $table->json('consultations')->nullable()->after('requirements');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('practical_topics', function (Blueprint $table) {
            //
        });
    }
};
