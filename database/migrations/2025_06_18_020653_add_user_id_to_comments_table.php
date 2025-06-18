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
        Schema::table('comments', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->after('news_id')->constrained()->onDelete('cascade');
            $table->string('author_name')->nullable()->change(); // Робимо nullable, бо тепер буде братися з user
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
            $table->string('author_name')->nullable(false)->change();
        });
    }
};
