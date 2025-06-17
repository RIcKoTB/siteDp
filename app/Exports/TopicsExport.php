<?php

namespace App\Exports;

use App\Models\PracticalTopic;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithTitle;

class TopicsExport implements FromQuery, WithHeadings, WithMapping, WithChunkReading, WithTitle
{
    protected $categorySlug;

    public function __construct($categorySlug = null)
    {
        $this->categorySlug = $categorySlug;
    }

    /**
    * @return \Illuminate\Database\Eloquent\Builder
    */
    public function query()
    {
        $query = PracticalTopic::query()->with('category:id,title');

        if ($this->categorySlug) {
            $query->whereHas('category', function($q) {
                $q->where('slug', $this->categorySlug);
            });
        }

        return $query;
    }

    public function chunkSize(): int
    {
        return 100;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Категорія',
            'Назва теми',
            'Опис',
            'Викладач',
            'Кількість годин',
            'Активна',
            'Керівник',
            'Посада керівника',
            'Email керівника',
            'Телефон керівника',
            'Біографія керівника',
            'Вимоги до студента',
            'Етапи виконання',
            'Корисні ресурси',
            'Консультації',
            'Дата створення',
        ];
    }

    public function map($topic): array
    {
        // Конвертуємо етапи в текст
        $stages = '';
        if ($topic->stages) {
            $stageTexts = [];
            foreach ($topic->stages as $stage) {
                $stageTexts[] = $stage['title'] ?? '';
            }
            $stages = implode('; ', $stageTexts);
        }

        // Конвертуємо ресурси в текст
        $resources = '';
        if ($topic->resources) {
            $resourceTexts = [];
            foreach ($topic->resources as $resource) {
                $resourceTexts[] = ($resource['title'] ?? '') . '|' . ($resource['description'] ?? '') . '|' . ($resource['url'] ?? '');
            }
            $resources = implode('; ', $resourceTexts);
        }

        // Конвертуємо консультації в текст
        $consultations = '';
        if ($topic->consultations) {
            $consultationTexts = [];
            foreach ($topic->consultations as $consultation) {
                $consultationTexts[] = ($consultation['teacher'] ?? '') . '|' . ($consultation['datetime'] ?? '') . '|' . ($consultation['location'] ?? '') . '|' . ($consultation['notes'] ?? '');
            }
            $consultations = implode('; ', $consultationTexts);
        }

        return [
            $topic->id,
            $topic->category ? $topic->category->title : '',
            $topic->title,
            $topic->description,
            $topic->teacher,
            $topic->hours,
            $topic->is_active ? 'Так' : 'Ні',
            $topic->supervisor_name,
            $topic->supervisor_position,
            $topic->supervisor_email,
            $topic->supervisor_phone,
            $topic->supervisor_bio,
            $topic->requirements,
            $stages,
            $resources,
            $consultations,
            $topic->created_at ? $topic->created_at->format('d.m.Y H:i') : '',
        ];
    }



    public function title(): string
    {
        return 'Теми практичної підготовки';
    }
}
