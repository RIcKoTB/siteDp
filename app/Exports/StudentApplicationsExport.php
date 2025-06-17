<?php

namespace App\Exports;

use App\Models\StudentApplication;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithTitle;

class StudentApplicationsExport implements FromQuery, WithHeadings, WithMapping, WithChunkReading, WithTitle
{
    protected $categorySlug;
    protected $status;

    public function __construct($categorySlug = null, $status = null)
    {
        $this->categorySlug = $categorySlug;
        $this->status = $status;
    }

    /**
    * @return \Illuminate\Database\Eloquent\Builder
    */
    public function query()
    {
        $query = StudentApplication::query()->with(['category', 'topic']);

        if ($this->categorySlug) {
            $query->whereHas('category', function($q) {
                $q->where('slug', $this->categorySlug);
            });
        }

        if ($this->status) {
            $query->where('status', $this->status);
        }

        return $query->orderBy('created_at', 'desc');
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
            'Тема',
            'Запропонована тема',
            'Ім\'я студента',
            'Email студента',
            'Телефон студента',
            'Група студента',
            'Опис',
            'Статус',
            'Примітки адміністратора',
            'Дата подачі',
            'Дата затвердження',
        ];
    }

    public function map($application): array
    {
        $statusLabels = [
            'pending' => 'Очікує розгляду',
            'approved' => 'Схвалено',
            'rejected' => 'Відхилено',
        ];

        return [
            $application->id,
            $application->category->title ?? '',
            $application->topic ? $application->topic->title : '',
            $application->proposed_title,
            $application->student_name,
            $application->student_email,
            $application->student_phone,
            $application->student_group,
            $application->description,
            $statusLabels[$application->status] ?? $application->status,
            $application->admin_notes,
            $application->created_at ? $application->created_at->format('d.m.Y H:i') : '',
            $application->approved_at ? $application->approved_at->format('d.m.Y H:i') : '',
        ];
    }



    public function title(): string
    {
        return 'Заявки студентів';
    }
}
