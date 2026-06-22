<p>Здравствуйте, {{ $data['request']['name'] }}!</p>

<p>Мы получили ваше обращение:</p>

<p><em>"{{ $data['request']['comment'] }}"</em></p>

<p><strong>Наш ответ:</strong><br>
{{ $data['ai']['reply'] }}</p>

<p>Спасибо, что написали нам!<br>
Будем ждать ещё!</p>
