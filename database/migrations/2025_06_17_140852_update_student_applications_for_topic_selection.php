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
        Schema::table('student_applications', function (Blueprint $table) {
            // Спочатку видаляємо foreign key constraint
            $table->dropForeign(['topic_id']);

            // Видаляємо поле proposed_title (більше не потрібне)
            $table->dropColumn('proposed_title');

            // Перейменовуємо description на motivation
            $table->renameColumn('description', 'motivation');

            // Робимо topic_id обов'язковим
            $table->bigInteger('topic_id')->unsigned()->nullable(false)->change();

            // Відновлюємо foreign key constraint
            $table->foreign('topic_id')->references('id')->on('practical_topics')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('student_applications', function (Blueprint $table) {
            $table->foreignId('topic_id')->nullable()->change();
            $table->string('proposed_title')->nullable();
            $table->renameColumn('motivation', 'description');
        });
    }
};
