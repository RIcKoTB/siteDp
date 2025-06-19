<?php

echo "=== Структура навігації Filament ===\n\n";

$resourcesDir = 'app/Filament/Resources/';
$files = glob($resourcesDir . '*Resource.php');

$navigation = [];

foreach ($files as $file) {
    $content = file_get_contents($file);
    $filename = basename($file, '.php');
    
    // Витягуємо navigationLabel
    preg_match('/protected static \?string \$navigationLabel = [\'"]([^\'"]+)[\'"];/', $content, $labelMatches);
    $label = $labelMatches[1] ?? $filename;
    
    // Витягуємо navigationGroup
    preg_match('/protected static \?string \$navigationGroup = [\'"]([^\'"]+)[\'"];/', $content, $groupMatches);
    $group = $groupMatches[1] ?? 'Без групи';
    
    // Витягуємо navigationSort
    preg_match('/protected static \?int \$navigationSort = (\d+);/', $content, $sortMatches);
    $sort = (int)($sortMatches[1] ?? 99);
    
    $navigation[] = [
        'file' => $filename,
        'label' => $label,
        'group' => $group,
        'sort' => $sort
    ];
}

// Сортуємо по групах та порядку
usort($navigation, function($a, $b) {
    if ($a['group'] === $b['group']) {
        return $a['sort'] - $b['sort'];
    }
    return strcmp($a['group'], $b['group']);
});

// Виводимо результат
$currentGroup = '';
foreach ($navigation as $item) {
    if ($item['group'] !== $currentGroup) {
        $currentGroup = $item['group'];
        echo "\n📁 {$currentGroup}:\n";
        echo str_repeat('-', 50) . "\n";
    }
    
    printf("  %2d. %-25s (%s)\n", $item['sort'], $item['label'], $item['file']);
}

echo "\n\nВсього ресурсів: " . count($navigation) . "\n";
echo "Груп: " . count(array_unique(array_column($navigation, 'group'))) . "\n";
?>
