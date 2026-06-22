# 🌐 DevAPI — Backend сервис с AI-интеграцией

https://loyal-harmony-devapi.up.railway.app/

Backend-сервис для персонального лендинга разработчика. Проект предоставляет REST API для обработки обращений пользователей, отправки email-уведомлений, логирования запросов, ограничения частоты обращений и AI-анализа сообщений.

В качестве хранилища используются JSON-файлы, что позволяет работать без подключения базы данных.

---

## Стек технологий

- PHP 8.1+
- Laravel 10
- Composer
- OpenRouter API
- Groq LLaMA 3.1 8B Instant
- Yandex SMTP
- JSON Storage

---

## Архитектура проекта

```text
app/
├── Http/
│   ├── Controllers/
│   │   ├── Api/
│   │   │   ├── ContactController.php
│   │   │   └── MetricsController.php
│   └── Middleware/
│       ├── RequestCounterMiddleware.php
│       ├── RequestLoggerMiddleware.php
│       └── RateLimitMiddleware.php
│
├── Services/
│   ├── Ai/
│   │   └── AiService.php
│   └── ContactService.php
│
├── Repositories/
│   └── ContactRequestRepository.php
│
├── Mail/
│   ├── ContactOwnerMail.php
│   └── ContactUserCopyMail.php
│
resources/
└── views/
    └── emails/
        ├── owner.blade.php
        └── user.blade.php

routes/
└── api.php

storage/
├── app/
│   ├── contact_requests.json
│   └── metrics.json
└── logs/
```

---

## API

### POST `/api/contact`

Отправка обращения пользователя.

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
    "sentiment": "positive",
    "reply": "Спасибо за обращение!",
    "ai_used": true
}
```

---

### GET `/api/health`

Проверка состояния сервиса.

#### Response

```json
{
    "status": "ok"
}
```

---

### GET `/api/metrics`

Получение статистики обращений.

#### Response

```json
{
    "total_requests": 125
}
```

---

## AI-интеграция

Для обработки пользовательских сообщений используется OpenRouter.

Используемая модель:

```text
groq/llama-3.1-8b-instant
```

Возможности AI:

- анализ тональности сообщения;
- генерация ответа пользователю;
- обработка ошибок AI-сервиса;
- fallback-механизм при недоступности модели.

---

## Хранение данных

Проект не использует СУБД.

Все данные сохраняются в JSON-файлы:

```text
storage/app/contact_requests.json
storage/app/metrics.json
```

Это позволяет быстро развернуть приложение без настройки базы данных.

---

## Email-уведомления

После получения обращения автоматически отправляются два письма:

1. Владельцу сайта.
2. Пользователю (копия обращения).

Для формирования писем используются Blade-шаблоны:

```text
resources/views/emails/owner.blade.php
resources/views/emails/user.blade.php
```

Отправка осуществляется через Yandex SMTP.

---

## Логирование

Каждый запрос логируется средствами Laravel.

Файлы логов:

```text
storage/logs/laravel.log
storage/logs/laravel-*.log
```

---

## Rate Limiting

Для защиты от спама реализовано ограничение количества запросов по IP-адресу.

При превышении лимита API возвращает:

```http
429 Too Many Requests
```

---

## Установка и запуск

### Клонирование проекта

```bash
git clone https://github.com/polshtva/devAPI.git
cd devAPI
```

### Установка зависимостей

```bash
composer install
```

### Создание файла окружения

```bash
cp .env.example .env
php artisan key:generate
```

### Настройка переменных окружения

```env
MAIL_HOST=smtp.yandex.ru
MAIL_PORT=465
MAIL_USERNAME=your-email@yandex.ru
MAIL_PASSWORD=your-password
MAIL_ENCRYPTION=ssl

OPENROUTER_API_KEY=sk-or-xxxxxxxxxxxxxxxx
```

### Запуск приложения

```bash
php artisan serve
```

После запуска API будет доступно по адресу:

```text
http://127.0.0.1:8000
```

---

## ✔ Реализовано

- REST API
- Валидация входящих данных
- JSON-хранилище без базы данных
- Email-уведомления
- Blade-шаблоны писем
- Логирование запросов
- Rate Limiting по IP
- AI-анализ сообщений
- Генерация ответов через LLM
- Fallback-механизм
- Health Check Endpoint
- Metrics Endpoint
- Сервисная архитектура Laravel
