<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;

class PracticalCategory extends Model
{
    protected $fillable = ['title', 'slug'];

    protected static function booted(): void
    {
        static::created(function ($category) {
            $slug = $category->slug;

            // 1. Topics
            $topicsTable = "{$slug}_topics";
            if (!Schema::hasTable($topicsTable)) {
                Schema::create($topicsTable, function (Blueprint $table) {
                    $table->id();
                    $table->string('title');
                    $table->text('description')->nullable();
                    $table->string('teacher')->nullable();
                    $table->timestamps();
                });
            }

            // 2. Requirements
            $requirementsTable = "{$slug}_requirements";
            if (!Schema::hasTable($requirementsTable)) {
                Schema::create($requirementsTable, function (Blueprint $table) {
                    $table->id();
                    $table->unsignedBigInteger('topic_id');
                    $table->text('requirement');
                    $table->timestamps();
                });
            }

            // 3. Timelines
            $timelinesTable = "{$slug}_timelines";
            if (!Schema::hasTable($timelinesTable)) {
                Schema::create($timelinesTable, function (Blueprint $table) {
                    $table->id();
                    $table->unsignedBigInteger('topic_id');
                    $table->date('date');
                    $table->string('stage');
                    $table->text('description')->nullable();
                    $table->timestamps();
                });
            }

            // 4. Links
            $linksTable = "{$slug}_links";
            if (!Schema::hasTable($linksTable)) {
                Schema::create($linksTable, function (Blueprint $table) {
                    $table->id();
                    $table->unsignedBigInteger('topic_id');
                    $table->string('url');
                    $table->string('text')->nullable();
                    $table->timestamps();
                });
            }
        });
    }
}
