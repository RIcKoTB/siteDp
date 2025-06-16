<?php

namespace App\Observers;

use App\Models\PracticalCategory;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class PracticalCategoryObserver
{
    public function created(PracticalCategory $category): void
    {
        $slug = Str::slug($category->slug);
        $tables = [
            'topics', 'requirements', 'timelines', 'links',
            'approveds', 'consultations'
        ];

        foreach ($tables as $table) {
            $tableName = "{$slug}_{$table}";
            $modelName = Str::studly(Str::singular($tableName));

            // 1. Міграція
            if (!Schema::hasTable($tableName)) {
                Artisan::call('make:migration', [
                    'name' => "create_{$tableName}_table",
                    '--create' => $tableName,
                    '--quiet' => true,
                ]);
                Artisan::call('migrate', ['--force' => true]);
            }

            // 2. Модель
            $modelPath = app_path("Models/Practical/{$modelName}.php");
            if (!file_exists($modelPath)) {
                Artisan::call('make:model', [
                    'name' => "Practical/{$modelName}",
                    '--quiet' => true,
                ]);

                if (Schema::hasTable($tableName)) {
                    $columns = Schema::getColumnListing($tableName);
                    $excluded = ['id', 'created_at', 'updated_at'];
                    $fillable = array_values(array_diff($columns, $excluded));
                    $fillableArray = "['" . implode("', '", $fillable) . "']";
                    $timestamps = in_array('created_at', $columns) && in_array('updated_at', $columns) ? 'true' : 'false';

                    $relationship = '';
                    if (!in_array($table, ['topics', 'consultations']) && in_array('topic_id', $columns)) {
                        $relatedModel = Str::studly(Str::singular("{$slug}_topics"));
                        $relationship = "\n    public function topic()\n    {\n        return \$this->belongsTo(\\App\\Models\\Practical\\{$relatedModel}::class);\n    }\n";
                    }

                    $content = "<?php\n\nnamespace App\\Models\\Practical;\n\nuse Illuminate\\Database\\Eloquent\\Model;\n\nclass {$modelName} extends Model\n{\n    protected \$table = '{$tableName}';\n    protected \$fillable = {$fillableArray};\n    public \$timestamps = {$timestamps};{$relationship}}";

                    file_put_contents($modelPath, $content);
                }
            }

            // 3. Filament-ресурс
            $resourcePath = app_path("Filament/Resources/Practical/{$modelName}Resource.php");
            if (!file_exists($resourcePath)) {
                Artisan::call('make:filament-resource', [
                    'name' => "Practical/{$modelName}",
                    '--generate' => true,
                    '--quiet' => true,
                ]);
            }

            // 4. navigationGroup
            if (file_exists($resourcePath)) {
                $content = file_get_contents($resourcePath);
                if (!str_contains($content, 'Практична підготовка')) {
                    $content = preg_replace(
                        '/protected static \?string \$navigationGroup\s*=.*?;/',
                        "protected static ?string \$navigationGroup = 'Практична підготовка';",
                        $content
                    );
                    file_put_contents($resourcePath, $content);
                }
            }

            // 5. Select topic_id
            if (!in_array($table, ['topics', 'consultations'])) {
                $relatedTable = "{$slug}_topics";
                $titleField = 'name';

                if (Schema::hasTable($relatedTable)) {
                    $columns = Schema::getColumnListing($relatedTable);
                    if (!in_array('name', $columns)) {
                        if (in_array('title', $columns)) {
                            $titleField = 'title';
                        } else {
                            foreach ($columns as $col) {
                                if (Schema::getColumnType($relatedTable, $col) === 'string') {
                                    $titleField = $col;
                                    break;
                                }
                            }
                        }
                    }
                }

                if (file_exists($resourcePath)) {
                    $content = file_get_contents($resourcePath);
                    $content = preg_replace('/Forms\\\\Components\\\\TextInput::make\\(\'topic_id\'\\)[\\s\\S]*?\\),/', '', $content);
                    $content = preg_replace(
                        '/->schema\(\[\n/',
                        "->schema([\n" .
                        "                Forms\\Components\\Select::make('topic_id')\n" .
                        "                    ->label('Topic')\n" .
                        "                    ->relationship('topic', '{$titleField}')\n" .
                        "                    ->searchable()\n" .
                        "                    ->preload()\n" .
                        "                    ->required(),\n",
                        $content
                    );
                    if (!str_contains($content, 'Forms\\Components\\Select')) {
                        $content = preg_replace(
                            '/use Filament\\\\Forms;/',
                            "use Filament\\Forms;\nuse Filament\\Forms\\Components\\Select;",
                            $content
                        );
                    }
                    file_put_contents($resourcePath, $content);
                }
            }
        }
    }
}
