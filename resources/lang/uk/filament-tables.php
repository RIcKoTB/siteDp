<?php

return [

    'columns' => [

        'text' => [

            'actions' => [
                'collapse_list' => 'Показати на :count менше',
                'expand_list' => 'Показати на :count більше',
            ],

            'more_list_items' => 'та ще :count',

        ],

    ],

    'fields' => [

        'bulk_select_page' => [
            'label' => 'Вибрати/скасувати вибір усіх елементів для масових дій.',
        ],

        'bulk_select_record' => [
            'label' => 'Вибрати/скасувати вибір елемента :key для масових дій.',
        ],

        'bulk_select_group' => [
            'label' => 'Вибрати/скасувати вибір групи :title для масових дій.',
        ],

        'search' => [
            'label' => 'Пошук',
            'placeholder' => 'Пошук',
            'indicator' => 'Пошук',
        ],

    ],

    'summary' => [

        'heading' => 'Підсумок',

        'subheadings' => [
            'all' => 'Всі :label',
            'group' => 'Підсумок :group',
            'page' => 'Ця сторінка',
        ],

        'summarizers' => [

            'average' => [
                'label' => 'Середнє',
            ],

            'count' => [
                'label' => 'Кількість',
            ],

            'sum' => [
                'label' => 'Сума',
            ],

        ],

    ],

    'actions' => [

        'disable_reordering' => [
            'label' => 'Завершити перевпорядкування записів',
        ],

        'enable_reordering' => [
            'label' => 'Перевпорядкувати записи',
        ],

        'filter' => [
            'label' => 'Фільтр',
        ],

        'group' => [
            'label' => 'Група',
        ],

        'open_bulk_actions' => [
            'label' => 'Відкрити дії',
        ],

        'toggle_columns' => [
            'label' => 'Перемкнути стовпці',
        ],

    ],

    'empty' => [

        'heading' => 'Записи не знайдені',

        'description' => 'Створіть :model, щоб почати.',

    ],

    'filters' => [

        'actions' => [

            'remove' => [
                'label' => 'Видалити фільтр',
            ],

            'remove_all' => [
                'label' => 'Видалити всі фільтри',
            ],

            'reset' => [
                'label' => 'Скинути фільтри',
            ],

        ],

        'heading' => 'Фільтри',

        'indicator' => 'Активні фільтри',

        'multi_select' => [
            'placeholder' => 'Всі',
        ],

        'select' => [
            'placeholder' => 'Всі',
        ],

        'trashed' => [

            'label' => 'Видалені записи',

            'only_trashed' => 'Тільки видалені записи',

            'with_trashed' => 'З видаленими записами',

            'without_trashed' => 'Без видалених записів',

        ],

    ],

    'grouping' => [

        'fields' => [

            'group' => [
                'label' => 'Групувати за',
                'placeholder' => 'Немає',
            ],

            'direction' => [

                'label' => 'Напрямок групування',

                'options' => [
                    'asc' => 'За зростанням',
                    'desc' => 'За спаданням',
                ],

            ],

        ],

    ],

    'reorder_indicator' => 'Перетягніть записи в порядку.',

    'selection_indicator' => [

        'selected_count' => '1 запис вибрано|:count записи вибрано',

        'actions' => [

            'select_all' => [
                'label' => 'Вибрати всі :count',
            ],

            'deselect_all' => [
                'label' => 'Скасувати вибір усіх',
            ],

        ],

    ],

    'sorting' => [

        'fields' => [

            'column' => [
                'label' => 'Сортувати за',
            ],

            'direction' => [

                'label' => 'Напрямок сортування',

                'options' => [
                    'asc' => 'За зростанням',
                    'desc' => 'За спаданням',
                ],

            ],

        ],

    ],

];
