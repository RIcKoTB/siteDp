<?php

namespace App\Imports;

use App\Models\PracticalTopic;
use App\Models\PracticalCategory;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class TopicsImport implements ToModel, WithHeadingRow, WithValidation, WithBatchInserts, WithChunkReading
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // Знаходимо категорію за назвою або створюємо нову
        $category = PracticalCategory::firstOrCreate(
            ['title' => $row['kategoriia'] ?? 'Загальна'],
            ['slug' => \Str::slug($row['kategoriia'] ?? 'zagalna'), 'content' => '']
        );

        // Парсимо JSON поля
        $stages = [];
        if (!empty($row['etapy_vykonannia'])) {
            $stagesText = explode(';', $row['etapy_vykonannia']);
            foreach ($stagesText as $index => $stage) {
                if (trim($stage)) {
                    $stages[] = [
                        'title' => trim($stage),
                        'description' => '',
                        'start_date' => null,
                        'end_date' => null,
                        'status' => 'pending'
                    ];
                }
            }
        }

        $resources = [];
        if (!empty($row['korysni_resursy'])) {
            $resourcesText = explode(';', $row['korysni_resursy']);
            foreach ($resourcesText as $resource) {
                if (trim($resource)) {
                    $parts = explode('|', trim($resource));
                    $resources[] = [
                        'title' => $parts[0] ?? trim($resource),
                        'description' => $parts[1] ?? '',
                        'url' => $parts[2] ?? '',
                        'type' => 'link',
                        'is_required' => false
                    ];
                }
            }
        }

        $consultations = [];
        if (!empty($row['konsultatsii'])) {
            $consultationsText = explode(';', $row['konsultatsii']);
            foreach ($consultationsText as $consultation) {
                if (trim($consultation)) {
                    $parts = explode('|', trim($consultation));
                    $consultations[] = [
                        'teacher' => $parts[0] ?? 'Викладач',
                        'datetime' => $parts[1] ?? null,
                        'location' => $parts[2] ?? '',
                        'notes' => $parts[3] ?? ''
                    ];
                }
            }
        }

        return new PracticalTopic([
            'category_id' => $category->id,
            'title' => $row['nazva_temy'] ?? '',
            'description' => $row['opys'] ?? '',
            'teacher' => $row['vykladach'] ?? '',
            'hours' => $row['kil_kist_godyn'] ?? 0,
            'is_active' => ($row['aktyvna'] ?? 'tak') === 'tak',
            'supervisor_name' => $row['kerivnyk_im_ia'] ?? '',
            'supervisor_position' => $row['kerivnyk_posada'] ?? '',
            'supervisor_email' => $row['kerivnyk_email'] ?? '',
            'supervisor_phone' => $row['kerivnyk_telefon'] ?? '',
            'supervisor_bio' => $row['kerivnyk_bio'] ?? '',
            'requirements' => $row['vymohy'] ?? '',
            'stages' => $stages,
            'resources' => $resources,
            'consultations' => $consultations,
        ]);
    }

    public function rules(): array
    {
        return [
            'nazva_temy' => 'required|string|max:255',
            'kategoriia' => 'required|string|max:255',
            'vykladach' => 'nullable|string|max:255',
            'kil_kist_godyn' => 'nullable|integer|min:0',
            'kerivnyk_email' => 'nullable|email',
        ];
    }

    public function batchSize(): int
    {
        return 100;
    }

    public function chunkSize(): int
    {
        return 100;
    }
}
