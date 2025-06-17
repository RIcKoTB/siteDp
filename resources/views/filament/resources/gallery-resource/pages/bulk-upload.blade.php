<x-filament-panels::page>
    <div class="space-y-6">
        <!-- Інструкції -->
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-blue-800">
                        Інструкції з масового завантаження
                    </h3>
                    <div class="mt-2 text-sm text-blue-700">
                        <ul class="list-disc list-inside space-y-1">
                            <li>Виберіть до 20 фотографій одночасно</li>
                            <li>Підтримувані формати: JPG, PNG, GIF</li>
                            <li>Можна використовувати редактор зображень для обрізки</li>
                            <li>Загальні налаштування будуть застосовані до всіх фото</li>
                            <li>Пізніше можна редагувати кожне фото індивідуально</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Форма -->
        <form wire:submit.prevent="uploadPhotos">
            {{ $this->form }}
            
            <div class="flex justify-end space-x-3 mt-6">
                {{ $this->getFormActions() }}
            </div>
        </form>

        <!-- Прогрес завантаження -->
        <div wire:loading wire:target="uploadPhotos" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white rounded-lg p-6 max-w-sm w-full mx-4">
                <div class="flex items-center space-x-3">
                    <svg class="animate-spin h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span class="text-gray-700">Завантаження фотографій...</span>
                </div>
                <div class="mt-3">
                    <div class="bg-gray-200 rounded-full h-2">
                        <div class="bg-blue-600 h-2 rounded-full animate-pulse" style="width: 60%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Покращення стилів для завантаження файлів */
        .fi-fo-file-upload {
            border: 2px dashed #e5e7eb;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        
        .fi-fo-file-upload:hover {
            border-color: #3b82f6;
            background-color: #f8fafc;
        }
        
        .fi-fo-file-upload.fi-fo-file-upload--has-files {
            border-color: #10b981;
            background-color: #f0fdf4;
        }
        
        /* Стилі для превью зображень */
        .fi-fo-file-upload-preview {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
            gap: 12px;
            margin-top: 16px;
        }
        
        .fi-fo-file-upload-preview img {
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease;
        }
        
        .fi-fo-file-upload-preview img:hover {
            transform: scale(1.05);
        }
    </style>

    <script>
        // Додаткова логіка для покращення UX
        document.addEventListener('DOMContentLoaded', function() {
            // Показуємо прогрес завантаження файлів
            const fileInputs = document.querySelectorAll('input[type="file"]');
            
            fileInputs.forEach(input => {
                input.addEventListener('change', function(e) {
                    const files = e.target.files;
                    if (files.length > 0) {
                        console.log(`Вибрано ${files.length} файлів для завантаження`);
                        
                        // Можна додати додаткову валідацію
                        let totalSize = 0;
                        for (let file of files) {
                            totalSize += file.size;
                        }
                        
                        // Перевіряємо розмір (наприклад, максимум 50MB)
                        const maxSize = 50 * 1024 * 1024; // 50MB
                        if (totalSize > maxSize) {
                            alert('Загальний розмір файлів перевищує 50MB. Будь ласка, виберіть менше файлів.');
                            e.target.value = '';
                        }
                    }
                });
            });
        });
    </script>
</x-filament-panels::page>
