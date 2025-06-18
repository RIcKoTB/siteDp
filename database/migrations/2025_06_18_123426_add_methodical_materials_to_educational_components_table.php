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
        Schema::table('educational_components', function (Blueprint $table) {
            $table->json('methodical_materials')->nullable()->after('literature');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('educational_components', function (Blueprint $table) {
            $table->dropColumn('methodical_materials');
        });
    }
};
