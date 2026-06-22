<h2>Новая заявка с сайта</h2>

<p><strong>Имя:</strong> {{ $data['request']['name'] }}</p>
<p><strong>Email:</strong> {{ $data['request']['email'] }}</p>
<p><strong>Телефон:</strong> {{ $data['request']['phone'] ?? '—' }}</p>
<p><strong>Сообщение:</strong> {{ $data['request']['comment'] }}</p>

<hr>

<h3>AI анализ</h3>
<p><strong>Тональность:</strong> {{ $data['request']['sentiment'] }}</p>
<p><strong>Ответ AI:</strong> {{ $data['request']['ai_reply'] }}</p>
<p><strong>AI использован:</strong> {{ $data['request']['ai_used'] ? 'Да' : 'Нет' }}</p>

<p><strong>Дата:</strong> {{ $data['request']['created_at'] }}</p>
