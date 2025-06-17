<?php

return [

    'components' => [

        'builder' => [

            'actions' => [

                'clone' => [
                    'label' => 'Клонувати',
                ],

                'add' => [
                    'label' => 'Додати до :label',
                ],

                'add_between' => [
                    'label' => 'Вставити',
                ],

                'delete' => [
                    'label' => 'Видалити',
                ],

                'reorder' => [
                    'label' => 'Перемістити',
                ],

                'move_down' => [
                    'label' => 'Перемістити вниз',
                ],

                'move_up' => [
                    'label' => 'Перемістити вгору',
                ],

                'collapse' => [
                    'label' => 'Згорнути',
                ],

                'expand' => [
                    'label' => 'Розгорнути',
                ],

                'collapse_all' => [
                    'label' => 'Згорнути всі',
                ],

                'expand_all' => [
                    'label' => 'Розгорнути всі',
                ],

            ],

        ],

        'checkbox_list' => [
            'search_prompt' => 'Почніть вводити для пошуку...',
        ],

        'file_upload' => [

            'editor' => [

                'actions' => [

                    'cancel' => [
                        'label' => 'Скасувати',
                    ],

                    'drag_crop' => [
                        'label' => 'Режим перетягування "обрізати"',
                    ],

                    'drag_move' => [
                        'label' => 'Режим перетягування "перемістити"',
                    ],

                    'flip_horizontal' => [
                        'label' => 'Відобразити зображення горизонтально',
                    ],

                    'flip_vertical' => [
                        'label' => 'Відобразити зображення вертикально',
                    ],

                    'move_down' => [
                        'label' => 'Перемістити зображення вниз',
                    ],

                    'move_left' => [
                        'label' => 'Перемістити зображення вліво',
                    ],

                    'move_right' => [
                        'label' => 'Перемістити зображення вправо',
                    ],

                    'move_up' => [
                        'label' => 'Перемістити зображення вгору',
                    ],

                    'reset' => [
                        'label' => 'Скинути',
                    ],

                    'rotate_left' => [
                        'label' => 'Повернути зображення вліво',
                    ],

                    'rotate_right' => [
                        'label' => 'Повернути зображення вправо',
                    ],

                    'save' => [
                        'label' => 'Зберегти',
                    ],

                    'zoom_100' => [
                        'label' => 'Масштабувати зображення до 100%',
                    ],

                    'zoom_in' => [
                        'label' => 'Збільшити',
                    ],

                    'zoom_out' => [
                        'label' => 'Зменшити',
                    ],

                ],

            ],

        ],

        'key_value' => [

            'actions' => [

                'add' => [
                    'label' => 'Додати рядок',
                ],

                'delete' => [
                    'label' => 'Видалити рядок',
                ],

                'reorder' => [
                    'label' => 'Перемістити рядок',
                ],

            ],

            'fields' => [

                'key' => [
                    'label' => 'Ключ',
                ],

                'value' => [
                    'label' => 'Значення',
                ],

            ],

        ],

        'markdown_editor' => [

            'toolbar_buttons' => [
                'attach_files' => 'Прикріпити файли',
                'blockquote' => 'Цитата',
                'bold' => 'Жирний',
                'bullet_list' => 'Маркований список',
                'code_block' => 'Блок коду',
                'heading' => 'Заголовок',
                'italic' => 'Курсив',
                'link' => 'Посилання',
                'ordered_list' => 'Нумерований список',
                'redo' => 'Повторити',
                'strike' => 'Закреслений',
                'table' => 'Таблиця',
                'undo' => 'Скасувати',
            ],

        ],

        'radio' => [

            'boolean' => [
                'true' => 'Так',
                'false' => 'Ні',
            ],

        ],

        'repeater' => [

            'actions' => [

                'add' => [
                    'label' => 'Додати до :label',
                ],

                'add_between' => [
                    'label' => 'Додати між',
                ],

                'delete' => [
                    'label' => 'Видалити',
                ],

                'clone' => [
                    'label' => 'Клонувати',
                ],

                'reorder' => [
                    'label' => 'Перемістити',
                ],

                'move_down' => [
                    'label' => 'Перемістити вниз',
                ],

                'move_up' => [
                    'label' => 'Перемістити вгору',
                ],

                'collapse' => [
                    'label' => 'Згорнути',
                ],

                'expand' => [
                    'label' => 'Розгорнути',
                ],

                'collapse_all' => [
                    'label' => 'Згорнути всі',
                ],

                'expand_all' => [
                    'label' => 'Розгорнути всі',
                ],

            ],

        ],

        'rich_editor' => [

            'dialogs' => [

                'link' => [

                    'actions' => [
                        'link' => 'Посилання',
                        'unlink' => 'Видалити посилання',
                    ],

                    'label' => 'URL',

                    'placeholder' => 'Введіть URL',

                ],

            ],

            'toolbar_buttons' => [
                'attach_files' => 'Прикріпити файли',
                'blockquote' => 'Цитата',
                'bold' => 'Жирний',
                'bullet_list' => 'Маркований список',
                'code_block' => 'Блок коду',
                'h1' => 'Заголовок',
                'h2' => 'Заголовок',
                'h3' => 'Заголовок',
                'italic' => 'Курсив',
                'link' => 'Посилання',
                'ordered_list' => 'Нумерований список',
                'redo' => 'Повторити',
                'strike' => 'Закреслений',
                'underline' => 'Підкреслений',
                'undo' => 'Скасувати',
            ],

        ],

        'select' => [

            'actions' => [

                'create_option' => [

                    'modal' => [

                        'heading' => 'Створити',

                        'actions' => [

                            'create' => [
                                'label' => 'Створити',
                            ],

                            'create_another' => [
                                'label' => 'Створити та створити ще один',
                            ],

                        ],

                    ],

                ],

                'edit_option' => [

                    'modal' => [

                        'heading' => 'Редагувати',

                        'actions' => [

                            'save' => [
                                'label' => 'Зберегти',
                            ],

                        ],

                    ],

                ],

            ],

            'boolean' => [
                'true' => 'Так',
                'false' => 'Ні',
            ],

            'loading_message' => 'Завантаження...',

            'max_items_message' => 'Можна вибрати лише :count.',

            'no_search_results_message' => 'Немає варіантів, що відповідають вашому пошуку.',

            'placeholder' => 'Виберіть варіант',

            'searching_message' => 'Пошук...',

            'search_prompt' => 'Почніть вводити для пошуку...',

        ],

        'tags_input' => [
            'placeholder' => 'Новий тег',
        ],

        'text_input' => [

            'actions' => [

                'hide_password' => [
                    'label' => 'Приховати пароль',
                ],

                'show_password' => [
                    'label' => 'Показати пароль',
                ],

            ],

        ],

        'toggle' => [

            'boolean' => [
                'true' => 'Так',
                'false' => 'Ні',
            ],

        ],

        'wizard' => [

            'actions' => [

                'previous_step' => [
                    'label' => 'Назад',
                ],

                'next_step' => [
                    'label' => 'Далі',
                ],

            ],

        ],

    ],

    'section' => [

        'collapse' => [
            'label' => 'Згорнути',
        ],

        'expand' => [
            'label' => 'Розгорнути',
        ],

    ],

    'collapsible' => [

        'collapsed' => [
            'label' => 'Згорнуто',
        ],

        'expanded' => [
            'label' => 'Розгорнуто',
        ],

    ],

];
