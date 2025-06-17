<?php

namespace App\Filament\Resources\PracticalTopicResource\Pages;

use App\Filament\Resources\PracticalTopicResource;
use App\Imports\TopicsImport;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Forms\Components\FileUpload;
use Maatwebsite\Excel\Facades\Excel;

class ListPracticalTopics extends ListRecords
{
    protected static string $resource = PracticalTopicResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Створити тему'),
            Actions\Action::make('import')
                ->label('Імпорт з Excel')
                ->icon('heroicon-o-arrow-up-tray')
                ->form([
                    \Filament\Forms\Components\Section::make('Інструкції з імпорту')
                        ->description('Створіть Excel файл з наступними колонками та заповніть його даними.')
                        ->schema([
                            \Filament\Forms\Components\Placeholder::make('instructions')
                                ->content('
                                    **Обов\'язкові колонки (заголовки в першому рядку):**
                                    - kategoriia - Назва категорії
                                    - nazva_temy - Назва теми

                                    **Додаткові колонки:**
                                    - opys - Опис теми
                                    - vykladach - Викладач
                                    - kil_kist_godyn - Кількість годин (число)
                                    - aktyvna - Активна (так/ні)
                                    - kerivnyk_im_ia - Ім\'я керівника
                                    - kerivnyk_posada - Посада керівника
                                    - kerivnyk_email - Email керівника
                                    - kerivnyk_telefon - Телефон керівника
                                    - kerivnyk_bio - Біографія керівника
                                    - vymohy - Вимоги до студента
                                    - etapy_vykonannia - Етапи (розділяйте ";")
                                    - korysni_resursy - Ресурси (формат "Назва|Опис|URL", розділяйте ";")
                                    - konsultatsii - Консультації (формат "Викладач|Дата|Місце|Примітки", розділяйте ";")
                                ')
                                ->columnSpanFull(),
                        ])
                        ->collapsible()
                        ->collapsed(),
                    FileUpload::make('file')
                        ->label('Excel файл')
                        ->acceptedFileTypes(['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.ms-excel', 'text/csv'])
                        ->directory('imports')
                        ->storeFileNamesIn('original_filename')
                        ->required()
                        ->helperText('Завантажте Excel файл з темами. Спочатку завантажте шаблон!'),
                ])
                ->action(function (array $data) {
                    try {
                        // Отримуємо шлях до завантаженого файлу
                        $filePath = storage_path('app/public/' . $data['file']);

                        if (!file_exists($filePath)) {
                            // Спробуємо альтернативний шлях
                            $filePath = storage_path('app/' . $data['file']);
                        }

                        if (!file_exists($filePath)) {
                            throw new \Exception('Файл не знайдено: ' . $data['file']);
                        }

                        Excel::import(new TopicsImport, $filePath);

                        // Видаляємо тимчасовий файл
                        if (file_exists($filePath)) {
                            unlink($filePath);
                        }

                        \Filament\Notifications\Notification::make()
                            ->title('Імпорт успішний!')
                            ->body('Теми успішно імпортовано з Excel файлу.')
                            ->success()
                            ->send();
                    } catch (\Exception $e) {
                        \Filament\Notifications\Notification::make()
                            ->title('Помилка імпорту')
                            ->body('Сталася помилка під час імпорту: ' . $e->getMessage())
                            ->danger()
                            ->send();
                    }
                }),

        ];
    }
}
