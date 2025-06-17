<?php

namespace App\Exports;

use App\Models\PracticalTopic;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class SimpleTopicsExport implements FromQuery, WithHeadings, WithMapping, WithChunkReading
{
    protected $categorySlug;

    public function __construct($categorySlug = null)
    {
        $this->categorySlug = $categorySlug;
    }

    public function query()
    {
        $query = PracticalTopic::query()->select([
            'id', 'category_id', 'title', 'description', 'teacher', 'hours', 'is_active',
            'supervisor_name', 'supervisor_email', 'created_at'
        ])->with('category:id,title');

        if ($this->categorySlug) {
            $query->whereHas('category', function($q) {
                $q->where('slug', $this->categorySlug);
            });
        }

        return $query;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Категорія',
            'Назва теми',
            'Опис',
            'Викладач',
            'Години',
            'Активна',
            'Керівник',
            'Email керівника',
            'Дата створення',
        ];
    }

    public function map($topic): array
    {
        return [
            $topic->id,
            $topic->category->title ?? '',
            $topic->title,
            $topic->description,
            $topic->teacher,
            $topic->hours,
            $topic->is_active ? 'Так' : 'Ні',
            $topic->supervisor_name,
            $topic->supervisor_email,
            $topic->created_at ? $topic->created_at->format('d.m.Y H:i') : '',
        ];
    }

    public function chunkSize(): int
    {
        return 500;
    }
}
