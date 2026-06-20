Новое обращение:

Имя: {{ $data['request']->name }}
Email: {{ $data['request']->email }}
Телефон: {{ $data['request']->phone }}

Комментарий:
{{ $data['request']->comment }}

AI:
Тональность: {{ $data['ai']['sentiment'] }}
Ответ: {{ $data['ai']['reply'] }}
AI использован: {{ $data['ai']['ai_used'] ? 'да' : 'нет' }}
