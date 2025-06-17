<?php

return [

    'components' => [

        'avatar' => [
            'alt' => 'Аватар користувача :name',
        ],

        'breadcrumbs' => [

            'actions' => [
                'toggle_sidebar' => 'Перемкнути бічну панель',
            ],

        ],

        'logo' => [
            'alt' => 'Логотип :name',
        ],

        'sidebar' => [

            'actions' => [
                'collapse' => 'Згорнути бічну панель',
                'expand' => 'Розгорнути бічну панель',
            ],

        ],

        'theme_switcher' => [

            'actions' => [

                'dark' => 'Перемкнути на темну тему',
                'light' => 'Перемкнути на світлу тему',
                'system' => 'Перемкнути на системну тему',

            ],

        ],

        'user_menu' => [

            'actions' => [
                'profile' => 'Профіль',
                'sign_out' => 'Вийти',
            ],

            'name' => 'Меню користувача',

        ],

    ],

    'pages' => [

        'dashboard' => [
            'title' => 'Панель управління',
        ],

        'health_check_results' => [
            'title' => 'Результати перевірки стану',
        ],

    ],

    'resources' => [

        'label' => 'Ресурс|Ресурси',

        'pages' => [

            'create_record' => [

                'title' => 'Створити :label',

                'breadcrumb' => 'Створити',

                'form' => [

                    'actions' => [

                        'cancel' => [
                            'label' => 'Скасувати',
                        ],

                        'create' => [
                            'label' => 'Створити',
                        ],

                        'create_another' => [
                            'label' => 'Створити та створити ще один',
                        ],

                    ],

                ],

                'notifications' => [

                    'created' => [
                        'title' => 'Створено',
                    ],

                ],

            ],

            'edit_record' => [

                'title' => 'Редагувати :label',

                'breadcrumb' => 'Редагувати',

                'form' => [

                    'actions' => [

                        'cancel' => [
                            'label' => 'Скасувати',
                        ],

                        'save' => [
                            'label' => 'Зберегти зміни',
                        ],

                    ],

                ],

                'content' => [

                    'tab' => [
                        'label' => 'Редагувати',
                    ],

                ],

                'notifications' => [

                    'saved' => [
                        'title' => 'Збережено',
                    ],

                ],

            ],

            'list_records' => [

                'title' => ':label',

                'navigation_label' => ':label',

                'breadcrumb' => ':label',

                'page' => [

                    'actions' => [

                        'create' => [
                            'label' => 'Новий :label',
                        ],

                    ],

                ],

                'table' => [

                    'actions' => [

                        'attach' => [
                            'label' => 'Прикріпити',
                        ],

                        'bulk_actions' => [
                            'label' => 'Масові дії',
                        ],

                        'create' => [
                            'label' => 'Новий :label',
                        ],

                        'delete' => [
                            'label' => 'Видалити',
                        ],

                        'detach' => [
                            'label' => 'Відкріпити',
                        ],

                        'edit' => [
                            'label' => 'Редагувати',
                        ],

                        'export' => [
                            'label' => 'Експорт',
                        ],

                        'filter' => [
                            'label' => 'Фільтр',
                        ],

                        'import' => [
                            'label' => 'Імпорт',
                        ],

                        'toggle_columns' => [
                            'label' => 'Перемкнути стовпці',
                        ],

                        'view' => [
                            'label' => 'Переглянути',
                        ],

                    ],

                    'bulk_actions' => [

                        'delete' => [
                            'label' => 'Видалити вибрані',
                        ],

                    ],

                    'columns' => [

                        'text' => [
                            'actions' => [
                                'collapse_list' => 'Показати на :count менше',
                                'expand_list' => 'Показати на :count більше',
                            ],
                        ],

                    ],

                    'filters' => [

                        'actions' => [
                            'remove' => 'Видалити фільтр',
                            'remove_all' => 'Видалити всі фільтри',
                            'reset' => 'Скинути',
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

                ],

            ],

        ],

        'relation_managers' => [

            'actions' => [

                'attach' => [
                    'label' => 'Прикріпити',
                ],

                'create' => [
                    'label' => 'Створити',
                ],

                'delete' => [
                    'label' => 'Видалити',
                ],

                'detach' => [
                    'label' => 'Відкріпити',
                ],

                'edit' => [
                    'label' => 'Редагувати',
                ],

                'view' => [
                    'label' => 'Переглянути',
                ],

            ],

            'modals' => [

                'attach' => [
                    'title' => 'Прикріпити :label',
                ],

                'create' => [
                    'title' => 'Створити :label',
                ],

                'edit' => [
                    'title' => 'Редагувати :label',
                ],

            ],

        ],

    ],

];
