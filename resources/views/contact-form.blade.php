<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Отправка сообщения — DevAPI</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-br from-gray-900 to-gray-800 text-white min-h-screen flex items-center justify-center">

<div class="w-full max-w-md bg-white/10 backdrop-blur-lg p-8 rounded-2xl shadow-xl animate-fadeIn">
    <h2 class="text-3xl font-bold text-center mb-6">Отправить сообщение</h2>

    <form id="contactForm" class="space-y-4">
        <div>
            <label class="block mb-1 text-sm">Имя</label>
            <input type="text" name="name" required
                   class="w-full px-4 py-2 rounded-lg bg-white/20 border border-white/10 focus:ring-2 focus:ring-indigo-400 outline-none">
        </div>

        <div>
            <label class="block mb-1 text-sm">Email</label>
            <input type="email" name="email" required
                   class="w-full px-4 py-2 rounded-lg bg-white/20 border border-white/10 focus:ring-2 focus:ring-indigo-400 outline-none">
        </div>

        <div>
            <label class="block mb-1 text-sm">Телефон</label>
            <input type="text" name="phone" required
                   class="w-full px-4 py-2 rounded-lg bg-white/20 border border-white/10 focus:ring-2 focus:ring-indigo-400 outline-none">
        </div>

        <div>
            <label class="block mb-1 text-sm">Сообщение</label>
            <textarea name="comment" required
                      class="w-full px-4 py-2 rounded-lg bg-white/20 border border-white/10 focus:ring-2 focus:ring-indigo-400 outline-none min-h-[120px]"></textarea>
        </div>

        <button type="submit"
                class="w-full py-3 bg-indigo-500 hover:bg-indigo-600 rounded-lg text-lg transition">
            Отправить
        </button>
    </form>

    <div id="resultBox"
         class="hidden mt-6 p-4 bg-white/10 rounded-lg text-sm whitespace-pre-wrap"></div>
</div>

<script>
const form = document.getElementById('contactForm');
const resultBox = document.getElementById('resultBox');

form.addEventListener('submit', async (e) => {
    e.preventDefault();

    resultBox.classList.remove('hidden');
    resultBox.className = "mt-6 p-4 rounded-lg text-sm whitespace-pre-wrap bg-white/10 text-white";
    resultBox.innerHTML = "Отправка...";

    try {
        const response = await fetch('/api/contact', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
            },
            body: JSON.stringify({
                name: form.name.value,
                email: form.email.value,
                phone: form.phone.value,
                comment: form.comment.value,
            })
        });

        const text = await response.text();

        // Попробуем распарсить JSON
        let json;
        try {
            json = JSON.parse(text);
        } catch {
            json = null;
        }

        if (!response.ok) {
            resultBox.className = "mt-6 p-4 rounded-lg text-sm whitespace-pre-wrap bg-red-500/20 border border-red-400 text-red-200";
            resultBox.innerHTML = json
                ? JSON.stringify(json, null, 2)
                : text;
            return;
        }

        resultBox.className = "mt-6 p-4 rounded-lg text-sm whitespace-pre-wrap bg-green-500/20 border border-green-400 text-green-200";
        resultBox.innerHTML = json
            ? JSON.stringify(json, null, 2)
            : text;

    } catch (err) {
        resultBox.className = "mt-6 p-1 rounded-lg text-sm whitespace-pre-wrap bg-red-500/20 border border-red-400 text-red-200";
        resultBox.innerHTML = "Ошибка: сервер недоступен\n" + err;
    }
});
</script>


</body>
</html>
