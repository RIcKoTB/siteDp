<?php

namespace App\Filament\Resources\GalleryResource\Pages;

use App\Filament\Resources\GalleryResource;
use App\Models\Gallery;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Actions;
use Filament\Resources\Pages\Page;
use Illuminate\Support\Facades\Storage;

class BulkUpload extends Page
{
    protected static string $resource = GalleryResource::class;

    protected static string $view = 'filament.resources.gallery-resource.pages.bulk-upload';

    protected static ?string $title = 'Масове завантаження фото';

    protected static ?string $navigationLabel = 'Масове завантаження';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Завантаження декількох фотографій')
                    ->description('Виберіть декілька фотографій для одночасного завантаження. Для кожного фото можна буде налаштувати індивідуальні параметри.')
                    ->schema([
                        Forms\Components\FileUpload::make('images')
                            ->label('Фотографії')
                            ->multiple()
                            ->image()
                            ->directory('gallery')
                            ->required()
                            ->maxFiles(20)
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '16:9',
                                '4:3',
                                '1:1',
                            ])
                            ->helperText('Максимум 20 фотографій за раз. Підтримувані формати: JPG, PNG, GIF'),
                    ]),
                
                Forms\Components\Section::make('Загальні налаштування')
                    ->description('Ці налаштування будуть застосовані до всіх завантажених фотографій. Пізніше можна буде змінити індивідуально.')
                    ->schema([
                        Forms\Components\Select::make('category')
                            ->label('Категорія')
                            ->options([
                                'general' => 'Загальні',
                                'classroom' => 'Аудиторії',
                                'students' => 'Студенти',
                                'events' => 'Події',
                                'graduation' => 'Випуски',
                                'laboratory' => 'Лабораторії',
                            ])
                            ->default('general')
                            ->required(),
                        Forms\Components\Toggle::make('is_active')
                            ->label('Активні за замовчуванням')
                            ->default(true),
                        Forms\Components\TextInput::make('title_prefix')
                            ->label('Префікс назви (необов\'язково)')
                            ->helperText('Буде додано до початку назви кожного фото'),
                        Forms\Components\Toggle::make('auto_generate_titles')
                            ->label('Автоматично генерувати назви')
                            ->helperText('Якщо увімкнено, назви будуть генеруватися автоматично на основі категорії та номера')
                            ->default(false),
                        Forms\Components\Textarea::make('default_description')
                            ->label('Опис за замовчуванням (необов\'язково)')
                            ->rows(3)
                            ->helperText('Буде застосовано до всіх фото, якщо не вказано інше'),
                    ])
                    ->columns(2),
            ])
            ->statePath('data');
    }

    protected function getFormActions(): array
    {
        return [
            Actions\Action::make('upload')
                ->label('Завантажити фотографії')
                ->color('primary')
                ->icon('heroicon-o-cloud-arrow-up')
                ->action('uploadPhotos'),
            Actions\Action::make('cancel')
                ->label('Скасувати')
                ->color('gray')
                ->url($this->getResource()::getUrl('index')),
        ];
    }

    public function uploadPhotos(): void
    {
        $data = $this->form->getState();
        
        if (empty($data['images'])) {
            Notification::make()
                ->title('Помилка')
                ->body('Будь ласка, виберіть хоча б одне фото для завантаження.')
                ->danger()
                ->send();
            return;
        }

        $uploadedCount = 0;
        $errors = [];

        foreach ($data['images'] as $index => $imagePath) {
            try {
                // Отримуємо оригінальну назву файлу без розширення
                $originalName = pathinfo($imagePath, PATHINFO_FILENAME);

                // Формуємо назву фото
                if ($data['auto_generate_titles'] ?? false) {
                    $categoryNames = [
                        'general' => 'Загальне фото',
                        'classroom' => 'Аудиторія',
                        'students' => 'Студенти',
                        'events' => 'Подія',
                        'graduation' => 'Випуск',
                        'laboratory' => 'Лабораторія',
                    ];
                    $categoryName = $categoryNames[$data['category']] ?? 'Фото';
                    $title = $categoryName . ' ' . ($index + 1);
                    if ($data['title_prefix']) {
                        $title = $data['title_prefix'] . ' - ' . $title;
                    }
                } else {
                    $title = $data['title_prefix']
                        ? $data['title_prefix'] . ' ' . $originalName
                        : $originalName;
                }

                // Створюємо запис в базі даних
                Gallery::create([
                    'title' => $title,
                    'description' => $data['default_description'] ?? null,
                    'image_path' => $imagePath,
                    'category' => $data['category'],
                    'is_active' => $data['is_active'] ?? true,
                    'sort_order' => Gallery::max('sort_order') + 1 + $index,
                ]);

                $uploadedCount++;
            } catch (\Exception $e) {
                $errors[] = "Помилка завантаження {$originalName}: " . $e->getMessage();
            }
        }

        // Показуємо результат
        if ($uploadedCount > 0) {
            Notification::make()
                ->title('Успішно завантажено!')
                ->body("Завантажено {$uploadedCount} фотографій до галереї.")
                ->success()
                ->send();
        }

        if (!empty($errors)) {
            Notification::make()
                ->title('Деякі фото не вдалося завантажити')
                ->body(implode("\n", $errors))
                ->warning()
                ->send();
        }

        // Очищуємо форму та перенаправляємо
        $this->form->fill();
        $this->redirect($this->getResource()::getUrl('index'));
    }
}
