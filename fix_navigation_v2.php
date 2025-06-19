<?php

// Скрипт для виправлення навігації в Filament ресурсах (версія 2)

$resources = [
    // Контент
    'NewsResource.php' => ['group' => 'Контент', 'sort' => 1, 'label' => 'Новини'],
    'CommentResource.php' => ['group' => 'Контент', 'sort' => 2, 'label' => 'Коментарі'],
    'GalleryResource.php' => ['group' => 'Контент', 'sort' => 3, 'label' => 'Галерея'],
    'GraduateResource.php' => ['group' => 'Контент', 'sort' => 4, 'label' => 'Випускники'],
    'ServiceResource.php' => ['group' => 'Контент', 'sort' => 5, 'label' => 'Послуги'],
    
    // Освітні програми
    'EducationalProgramResource.php' => ['group' => 'Освітні програми', 'sort' => 1, 'label' => 'Програми'],
    'EducationalCategoryResource.php' => ['group' => 'Освітні програми', 'sort' => 2, 'label' => 'Категорії'],
    'EducationalComponentResource.php' => ['group' => 'Освітні програми', 'sort' => 3, 'label' => 'Компоненти'],
    
    // Практична підготовка
    'PracticalTopicResource.php' => ['group' => 'Практична підготовка', 'sort' => 1, 'label' => 'Теми'],
    'PracticalCategoryResource.php' => ['group' => 'Практична підготовка', 'sort' => 2, 'label' => 'Категорії'],
    'StudentApplicationResource.php' => ['group' => 'Практична підготовка', 'sort' => 3, 'label' => 'Заявки студентів'],
    
    // Опитування
    'SurveyResource.php' => ['group' => 'Опитування', 'sort' => 1, 'label' => 'Опитування'],
    'SurveyResponseResource.php' => ['group' => 'Опитування', 'sort' => 2, 'label' => 'Результати опитувань'],
    
    // Користувачі та ролі
    'UserResource.php' => ['group' => 'Користувачі та ролі', 'sort' => 1, 'label' => 'Користувачі'],
    'RoleResource.php' => ['group' => 'Користувачі та ролі', 'sort' => 2, 'label' => 'Ролі'],
    
    // Налаштування
    'ContactSettingResource.php' => ['group' => 'Налаштування', 'sort' => 1, 'label' => 'Контакти'],
];

foreach ($resources as $filename => $config) {
    $filepath = "app/Filament/Resources/$filename";
    
    if (!file_exists($filepath)) {
        echo "File not found: $filepath\n";
        continue;
    }
    
    $content = file_get_contents($filepath);
    
    // Видаляємо існуючі navigationGroup та navigationSort
    $content = preg_replace('/\s*protected static \?\$navigationGroup = [^;]+;/', '', $content);
    $content = preg_replace('/\s*protected static \?string \$navigationGroup = [^;]+;/', '', $content);
    $content = preg_replace('/\s*protected static \?\$navigationSort = [^;]+;/', '', $content);
    $content = preg_replace('/\s*protected static \?int \$navigationSort = [^;]+;/', '', $content);
    
    // Оновлюємо або додаємо navigationLabel
    $labelPatterns = [
        '/protected static \?\$navigationLabel = [^;]+;/',
        '/protected static \?string \$navigationLabel = [^;]+;/',
    ];
    
    $labelFound = false;
    foreach ($labelPatterns as $pattern) {
        if (preg_match($pattern, $content)) {
            $content = preg_replace($pattern, "protected static ?\$navigationLabel = '{$config['label']}';", $content);
            $labelFound = true;
            break;
        }
    }
    
    // Якщо navigationLabel не знайдено, додаємо після navigationIcon
    if (!$labelFound) {
        $iconPattern = '/(protected static \?\$navigationIcon = [^;]+;)/';
        if (preg_match($iconPattern, $content)) {
            $replacement = "$1\n\n    protected static ?\$navigationLabel = '{$config['label']}';";
            $content = preg_replace($iconPattern, $replacement, $content);
        }
    }
    
    // Додаємо navigationGroup та navigationSort після navigationLabel
    $labelPattern = '/(protected static \?\$navigationLabel = [^;]+;)/';
    if (preg_match($labelPattern, $content)) {
        $replacement = "$1\n\n    protected static ?\$navigationGroup = '{$config['group']}';\n\n    protected static ?\$navigationSort = {$config['sort']};";
        $content = preg_replace($labelPattern, $replacement, $content);
        
        file_put_contents($filepath, $content);
        echo "Updated: $filename -> Label: {$config['label']}, Group: {$config['group']}, Sort: {$config['sort']}\n";
    } else {
        echo "Could not update: $filename\n";
    }
}

echo "\nNavigation fix completed!\n";
?>
