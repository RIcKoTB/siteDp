<?php

// Скрипт для виправлення навігації в Filament ресурсах

$resources = [
    // Контент
    'NewsResource.php' => ['group' => 'Контент', 'sort' => 1],
    'CommentResource.php' => ['group' => 'Контент', 'sort' => 2],
    'GalleryResource.php' => ['group' => 'Контент', 'sort' => 3],
    'GraduateResource.php' => ['group' => 'Контент', 'sort' => 4],
    'ServiceResource.php' => ['group' => 'Контент', 'sort' => 5],
    
    // Освітні програми
    'EducationalProgramResource.php' => ['group' => 'Освітні програми', 'sort' => 1],
    'EducationalCategoryResource.php' => ['group' => 'Освітні програми', 'sort' => 2],
    'EducationalComponentResource.php' => ['group' => 'Освітні програми', 'sort' => 3],
    
    // Практична підготовка
    'PracticalTopicResource.php' => ['group' => 'Практична підготовка', 'sort' => 1],
    'PracticalCategoryResource.php' => ['group' => 'Практична підготовка', 'sort' => 2],
    'StudentApplicationResource.php' => ['group' => 'Практична підготовка', 'sort' => 3],
    
    // Опитування
    'SurveyResource.php' => ['group' => 'Опитування', 'sort' => 1],
    'SurveyResponseResource.php' => ['group' => 'Опитування', 'sort' => 2],
    
    // Користувачі та ролі
    'UserResource.php' => ['group' => 'Користувачі та ролі', 'sort' => 1],
    'RoleResource.php' => ['group' => 'Користувачі та ролі', 'sort' => 2],
    'PermissionResource.php' => ['group' => 'Користувачі та ролі', 'sort' => 3],
    
    // Про нас
    'TeamMemberResource.php' => ['group' => 'Про нас', 'sort' => 1],
    'HistoryEventResource.php' => ['group' => 'Про нас', 'sort' => 2],
    'CoreValueResource.php' => ['group' => 'Про нас', 'sort' => 3],
    
    // Налаштування
    'ContactSettingResource.php' => ['group' => 'Налаштування', 'sort' => 1],
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
    $content = preg_replace('/\s*protected static \?\$navigationSort = [^;]+;/', '', $content);
    
    // Знаходимо позицію після navigationLabel
    $pattern = '/(protected static \?\$navigationLabel = [^;]+;)/';
    if (preg_match($pattern, $content)) {
        $replacement = "$1\n\n    protected static ?\$navigationGroup = '{$config['group']}';\n\n    protected static ?\$navigationSort = {$config['sort']};";
        $content = preg_replace($pattern, $replacement, $content);
        
        file_put_contents($filepath, $content);
        echo "Updated: $filename -> Group: {$config['group']}, Sort: {$config['sort']}\n";
    } else {
        echo "navigationLabel not found in: $filename\n";
    }
}

echo "\nNavigation fix completed!\n";
?>
