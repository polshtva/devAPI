<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DevAPI</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-br from-gray-900 to-gray-800 text-white h-screen flex items-center justify-center">

<div class="text-center max-w-xl p-10 bg-white/10 backdrop-blur-lg rounded-2xl shadow-2xl animate-fadeIn">
    <h1 class="text-4xl font-bold mb-3">DevAPI</h1>
    <p class="text-lg opacity-80 mb-8">Сервис успешно работает. Добро пожаловать!</p>

    <div class="flex justify-center gap-4 mb-6">
        <a href="/api/health"
           class="px-6 py-3 bg-indigo-500 hover:bg-indigo-600 rounded-lg text-lg transition">
            Проверить статус API
        </a>

        <a href="/contact-form"
           class="px-6 py-3 bg-purple-500 hover:bg-purple-600 rounded-lg text-lg transition">
            Отправить сообщение
        </a>
    </div>

    <div class="text-sm opacity-80">
        <div class="flex justify-center gap-4">
            <a href="/api/metrics" class="text-indigo-300 hover:underline">Статистика</a>
        </div>
    </div>
</div>

</body>
</html>
