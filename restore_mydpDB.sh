#!/bin/bash

# 🚀 Скрипт для відновлення бази даних mydpDB.sql
# Використання: ./restore_mydpDB.sh [database_name] [mysql_user] [mysql_password]

# Кольори для виводу
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Параметри за замовчуванням
DEFAULT_DB_NAME="site_dp_back"
DEFAULT_USER="root"
DEFAULT_DUMP_FILE="mydpDB.sql"

# Отримання параметрів
DB_NAME=${1:-$DEFAULT_DB_NAME}
MYSQL_USER=${2:-$DEFAULT_USER}
MYSQL_PASSWORD=$3
DUMP_FILE=${4:-$DEFAULT_DUMP_FILE}

echo -e "${BLUE}🚀 Скрипт відновлення бази даних mydpDB${NC}"
echo -e "${BLUE}=========================================${NC}"

# Перевірка наявності файлу дампу
if [ ! -f "$DUMP_FILE" ]; then
    echo -e "${RED}❌ Файл дампу '$DUMP_FILE' не знайдено!${NC}"
    echo -e "${YELLOW}Переконайтеся, що файл mydpDB.sql знаходиться в поточній директорії.${NC}"
    exit 1
fi

# Запит пароля, якщо не вказано
if [ -z "$MYSQL_PASSWORD" ]; then
    echo -e "${YELLOW}🔐 Введіть пароль MySQL для користувача '$MYSQL_USER':${NC}"
    read -s MYSQL_PASSWORD
fi

echo -e "${BLUE}📋 Параметри відновлення:${NC}"
echo -e "  База даних: ${GREEN}$DB_NAME${NC}"
echo -e "  Користувач: ${GREEN}$MYSQL_USER${NC}"
echo -e "  Файл дампу: ${GREEN}$DUMP_FILE${NC}"
echo -e "  Розмір файлу: ${GREEN}$(ls -lah $DUMP_FILE | awk '{print $5}')${NC}"
echo ""

# Перевірка підключення до MySQL
echo -e "${YELLOW}🔍 Перевірка підключення до MySQL...${NC}"
mysql -u "$MYSQL_USER" -p"$MYSQL_PASSWORD" -e "SELECT 1;" >/dev/null 2>&1
if [ $? -ne 0 ]; then
    echo -e "${RED}❌ Не вдалося підключитися до MySQL!${NC}"
    echo -e "${YELLOW}Перевірте користувача та пароль.${NC}"
    exit 1
fi
echo -e "${GREEN}✅ Підключення до MySQL успішне${NC}"

# Створення бази даних
echo -e "${YELLOW}🗄️  Створення бази даних '$DB_NAME'...${NC}"
mysql -u "$MYSQL_USER" -p"$MYSQL_PASSWORD" -e "CREATE DATABASE IF NOT EXISTS \`$DB_NAME\` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;" 2>/dev/null
if [ $? -eq 0 ]; then
    echo -e "${GREEN}✅ База даних створена або вже існує${NC}"
else
    echo -e "${RED}❌ Помилка створення бази даних${NC}"
    exit 1
fi

# Відновлення дампу
echo -e "${YELLOW}📥 Відновлення дампу mydpDB.sql...${NC}"
mysql -u "$MYSQL_USER" -p"$MYSQL_PASSWORD" "$DB_NAME" < "$DUMP_FILE" 2>/dev/null
if [ $? -eq 0 ]; then
    echo -e "${GREEN}✅ Дамп успішно відновлено${NC}"
else
    echo -e "${RED}❌ Помилка відновлення дампу${NC}"
    exit 1
fi

# Перевірка таблиць
echo -e "${YELLOW}🔍 Перевірка відновлених таблиць...${NC}"
TABLE_COUNT=$(mysql -u "$MYSQL_USER" -p"$MYSQL_PASSWORD" "$DB_NAME" -e "SHOW TABLES;" 2>/dev/null | wc -l)
TABLE_COUNT=$((TABLE_COUNT - 1)) # Віднімаємо заголовок

if [ $TABLE_COUNT -gt 0 ]; then
    echo -e "${GREEN}✅ Відновлено $TABLE_COUNT таблиць${NC}"
else
    echo -e "${RED}❌ Таблиці не знайдено${NC}"
    exit 1
fi

# Перевірка даних
echo -e "${YELLOW}📊 Перевірка даних...${NC}"
USER_COUNT=$(mysql -u "$MYSQL_USER" -p"$MYSQL_PASSWORD" "$DB_NAME" -e "SELECT COUNT(*) FROM users;" 2>/dev/null | tail -1)
NEWS_COUNT=$(mysql -u "$MYSQL_USER" -p"$MYSQL_PASSWORD" "$DB_NAME" -e "SELECT COUNT(*) FROM news;" 2>/dev/null | tail -1)
TOPICS_COUNT=$(mysql -u "$MYSQL_USER" -p"$MYSQL_PASSWORD" "$DB_NAME" -e "SELECT COUNT(*) FROM practical_topics;" 2>/dev/null | tail -1)

echo -e "${GREEN}✅ Користувачі: $USER_COUNT${NC}"
echo -e "${GREEN}✅ Новини: $NEWS_COUNT${NC}"
echo -e "${GREEN}✅ Теми практик: $TOPICS_COUNT${NC}"

echo ""
echo -e "${GREEN}🎉 База даних mydpDB успішно відновлена!${NC}"
echo -e "${BLUE}📋 Наступні кроки:${NC}"
echo -e "  1. Налаштуйте .env файл"
echo -e "  2. Запустіть: ${YELLOW}php artisan key:generate${NC}"
echo -e "  3. Запустіть: ${YELLOW}php artisan storage:link${NC}"
echo -e "  4. Запустіть: ${YELLOW}php artisan serve${NC}"
echo ""
echo -e "${BLUE}🔗 Підключення до бази:${NC}"
echo -e "  DB_DATABASE=$DB_NAME"
echo -e "  DB_USERNAME=$MYSQL_USER"
echo -e "  DB_PASSWORD=your_password"
echo ""
echo -e "${BLUE}🌐 Доступ до додатку:${NC}"
echo -e "  Frontend: ${YELLOW}http://localhost:8000${NC}"
echo -e "  Admin Panel: ${YELLOW}http://localhost:8000/admin${NC}"
echo -e "  Login: admin@admin.com / password"
