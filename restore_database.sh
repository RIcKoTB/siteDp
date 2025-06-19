#!/bin/bash

# Скрипт для відновлення бази даних
# Використання: ./restore_database.sh [database_name] [username]

# Параметри за замовчуванням
DB_NAME=${1:-site_dp_back}
DB_USER=${2:-root}
BACKUP_FILE="database_backup.sql"
COMPRESSED_BACKUP="database_backup.sql.gz"

echo "🗃️  Скрипт відновлення бази даних"
echo "=================================="
echo "База даних: $DB_NAME"
echo "Користувач: $DB_USER"
echo ""

# Перевіряємо наявність файлів дампу
if [ -f "$COMPRESSED_BACKUP" ]; then
    echo "✅ Знайдено стиснутий дамп: $COMPRESSED_BACKUP"
    RESTORE_FILE="$COMPRESSED_BACKUP"
    USE_COMPRESSED=true
elif [ -f "$BACKUP_FILE" ]; then
    echo "✅ Знайдено дамп: $BACKUP_FILE"
    RESTORE_FILE="$BACKUP_FILE"
    USE_COMPRESSED=false
else
    echo "❌ Файли дампу не знайдено!"
    echo "Очікувані файли: $BACKUP_FILE або $COMPRESSED_BACKUP"
    exit 1
fi

# Запитуємо підтвердження
echo ""
echo "⚠️  УВАГА: Це видалить всі існуючі дані в базі $DB_NAME"
read -p "Продовжити? (y/N): " -n 1 -r
echo ""

if [[ ! $REPLY =~ ^[Yy]$ ]]; then
    echo "❌ Відновлення скасовано"
    exit 1
fi

# Запитуємо пароль
echo ""
read -s -p "🔐 Введіть пароль для користувача $DB_USER: " DB_PASSWORD
echo ""

# Створюємо базу даних якщо не існує
echo ""
echo "📝 Створення бази даних (якщо не існує)..."
mysql -u "$DB_USER" -p"$DB_PASSWORD" -e "CREATE DATABASE IF NOT EXISTS \`$DB_NAME\` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;" 2>/dev/null

if [ $? -ne 0 ]; then
    echo "❌ Помилка підключення до MySQL"
    exit 1
fi

# Відновлюємо дамп
echo "🔄 Відновлення бази даних..."

if [ "$USE_COMPRESSED" = true ]; then
    # Відновлення зі стиснутого файлу
    gunzip -c "$RESTORE_FILE" | mysql -u "$DB_USER" -p"$DB_PASSWORD" "$DB_NAME"
else
    # Відновлення з звичайного файлу
    mysql -u "$DB_USER" -p"$DB_PASSWORD" "$DB_NAME" < "$RESTORE_FILE"
fi

if [ $? -eq 0 ]; then
    echo "✅ База даних успішно відновлена!"
    echo ""
    echo "📊 Інформація про відновлену базу:"
    mysql -u "$DB_USER" -p"$DB_PASSWORD" "$DB_NAME" -e "SELECT COUNT(*) as 'Кількість таблиць' FROM information_schema.tables WHERE table_schema = '$DB_NAME';" 2>/dev/null
    echo ""
    echo "🎯 Наступні кроки:"
    echo "1. Перевірте налаштування .env файлу"
    echo "2. Запустіть: php artisan config:clear"
    echo "3. Запустіть: php artisan cache:clear"
    echo "4. Перевірте роботу сайту"
else
    echo "❌ Помилка при відновленні бази даних"
    exit 1
fi
