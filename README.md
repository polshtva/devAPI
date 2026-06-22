# 🌐 DevAPI — Backend сервис с AI-интеграцией

Backend-сервис для персонального лендинга разработчика. Реализует REST API для формы обратной связи, отправку писем, логирование, rate limiting, PostgreSQL-хранение и интеграцию с AI через OpenRouter (Groq).

---

## 🚀 Стек технологий

- PHP 8.1+
- Laravel 10
- PostgreSQL
- Composer
- OpenRouter API
- Groq LLaMA 3.1 8B Instant
- Yandex SMTP
- File-based Logging
- Railway

---

## 📁 Архитектура проекта

```text
app/
├── Http/
│   ├── Controllers/
│   └── Middleware/
├── Models/
├── Services/
│   ├── Ai/
│   └── Mail/
database/
├── migrations/
routes/
├── api.php
storage/
Procfile
composer.json
```

---

## 🔌 API Endpoints

### POST `/api/contact`

Создание обращения через форму обратной связи.

#### Request

```json
{
    "name": "Полина",
    "email": "test@example.com",
    "phone": "+3710000000",
    "comment": "Хочу узнать подробнее"
}
```

#### Response

```json
{
    "id": 17,
    "sentiment": "positive",
    "reply": "Спасибо за обращение! ...",
    "ai_used": true
}
```

---

### GET `/api/health`

Проверка работоспособности сервиса.

#### Response

```json
{
    "status": "ok"
}
```

---

### GET `/api/metrics`

Получение статистики обращений.

---

## 🧠 AI-интеграция

Сервис использует AI для:

- Анализа тональности сообщения
- Генерации ответа пользователю
- Автоматического fallback при недоступности AI

### Используемая модель

```text
groq/llama-3.1-8b-instant
```

---

## 🛡 Rate Limiting

Защита от спама реализована через ограничение количества запросов по IP.

Файл хранения лимитов:

```text
storage/app/rate_limit.json
```

При превышении лимита API возвращает:

```http
429 Too Many Requests
```

---

## 📝 Логирование

Каждый запрос записывается в лог:

```text
storage/logs/requests.log
```

---

## 📧 Email-уведомления

После получения обращения отправляются два письма:

1. Владельцу сайта
2. Пользователю (копия обращения)

Почтовый провайдер:

```text
Yandex SMTP
```

---

## 🗄 PostgreSQL

### Настройки подключения

```env
DB_CONNECTION=pgsql
DB_HOST=${PGHOST}
DB_PORT=${PGPORT}
DB_DATABASE=${PGDATABASE}
DB_USERNAME=${PGUSER}
DB_PASSWORD=${PGPASSWORD}
```

### Выполнение миграций

```bash
php artisan migrate --force
```

---

## ⚙️ Установка и запуск локально

### 1. Клонировать проект

```bash
git clone https://github.com/polshtva/devAPI.git
cd devAPI
```

### 2. Установить зависимости

```bash
composer install
```

### 3. Создать .env

```bash
cp .env.example .env
php artisan key:generate
```

### 4. Настроить переменные окружения

```env
APP_ENV=local
APP_DEBUG=true

DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=dev_landing
DB_USERNAME=postgres
DB_PASSWORD=password

MAIL_HOST=smtp.yandex.ru
MAIL_PORT=465
MAIL_USERNAME=it-platform@yandex.ru
MAIL_PASSWORD=password
MAIL_ENCRYPTION=ssl

AI_PROVIDER=openrouter
OPENROUTER_API_KEY=sk-or-xxxxxxxxxxxxxxxx
```

### 5. Запустить сервер

```bash
php artisan serve
```

## ✔ Реализовано

- REST API
- Валидация запросов
- PostgreSQL
- Отправка email
- Логирование
- Rate limiting
- AI-интеграция
- Fallback-механизм
- Health Check
- Metrics API
- Чистая архитектура
- Деплой на Railway

---

## 📄 Лицензия

Проект создан для использования в качестве backend-части персонального сайта разработчика.

© 2025 DevAPI
