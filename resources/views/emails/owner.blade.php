<h2>Новая заявка с сайта</h2>

<p><strong>Имя:</strong> {{ $request['name'] }}</p>
<p><strong>Email:</strong> {{ $request['email'] }}</p>
<p><strong>Комментарий:</strong> {{ $request['comment'] }}</p>

<hr>

<h3>AI анализ</h3>
<p><strong>Тональность:</strong> {{ $request['sentiment'] }}</p>
<p><strong>Ответ AI:</strong> {{ $request['ai_reply'] }}</p>
<p><strong>AI использован:</strong> {{ $request['ai_used'] ? 'Да' : 'Нет' }}</p>

<p><strong>Дата:</strong> {{ $request['created_at'] }}</p>
