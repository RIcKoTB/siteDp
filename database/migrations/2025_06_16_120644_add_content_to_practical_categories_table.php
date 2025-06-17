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
        Schema::table('practical_categories', function (Blueprint $table) {
            if (!Schema::hasColumn('practical_categories', 'content')) {
                $table->text('content')->nullable()->after('slug');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('practical_categories', function (Blueprint $table) {
            if (Schema::hasColumn('practical_categories', 'content')) {
                $table->dropColumn('content');
            }
        });
    }
};
