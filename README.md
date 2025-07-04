# App Tire Station Service

Этот проект создан в рамках технического задания.  
Он представляет собой веб-приложение для работы со станциями шиномонтажа.

Для быстрой локальной установки используется база данных **SQLite**.

## ⚙️ Стек технологий

- PHP (Laravel)
- JavaScript (Vite, Vue 3)
- SQLite (по умолчанию)
- Node.js / npm

## 📦 Установка и запуск

Перед запуском убедитесь, что у вас установлены:

- PHP >= 8.1
- Composer
- Node.js и npm

### ⏳ Шаги для запуска:

```bash
# 1. Установка PHP-зависимостей
composer install

# 2. Установка JS-зависимостей
npm install

# 3. Создание файла базы данных SQLite
touch database/database.sqlite

# 4. Выполнение миграций
php artisan migrate

# 5. Наполнение базы тестовыми данными
php artisan db:seed

# 6. Запуск Laravel-сервера
php artisan serve

# 7. Запуск фронтенда в режиме разработки
npm run dev

# или

# Сборка фронтенда для продакшена
npm run build
