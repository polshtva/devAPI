# DevAPI — Backend сервис с AI‑интеграцией

Backend‑сервис для лендинга разработчика.  
Реализует REST API для формы обратной связи, отправку писем, логирование, rate limiting и интеграцию с AI (OpenRouter → Groq).

---

## 🚀 Стек технологий

- PHP 8.1+
- Laravel 10
- Composer
- OpenRouter (Groq LLaMA 3.1 8B Instant)
- Yandex SMTP
- File‑based logging
- Railway (деплой)

---

## 📂 Архитектура проекта

app/
├── Http/
│ ├── Controllers/ContactController.php
│ ├── Middleware/RequestLoggerMiddleware.php
│ ├── Middleware/RateLimitMiddleware.php
├── Services/
│ ├── Ai/AiService.php
│ ├── Mail/ContactMail.php
├── Exceptions/Handler.php
config/
├── services.php
routes/
├── api.php
storage/
├── logs/requests.log
├── app/metrics.json
├── app/rate_limit.json

API эндпоинты

### POST /api/contact

Отправка формы обратной связи.

**Пример входных данных:**

```json
{
  "name": "Полина",
  "email": "test@example.com",
  "phone": "+3710000000",
  "comment": "Хочу узнать подробнее"
}

Пример ответа:
{
  "id": 17,
  "sentiment": "positive",
  "reply": "Спасибо за обращение! ...",
  "ai_used": true
}


GET /api/health - Проверка статуса сервиса.
{"status": "ok"}

GET /api/metrics - Статистика обращений (хранится в файле).

AI‑интеграция
AI выполняет:

- анализ тональности комментария
- генерацию ответа пользователю
- fallback при недоступности AI

Rate Limiting
Реализован через middleware:
- хранение данных в storage/app/rate_limit.json
- ограничение по IP
- возврат 429 Too Many Requests при превышении лимита

Логирование
Каждый запрос пишется в: storage/logs/requests.log
Формат: [2024-06-20 12:00:00] POST /api/contact — IP: 127.0.0.1


Email‑уведомления

Отправляются два письма:
1.владельцу сайта
2.пользователю (копия)

Используется SMTP Yandex.


```
