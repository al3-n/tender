{% extends 'email/templates/default.php' %}

{% block content %}
<p>Вы отправили запрос на восстановление пароля.</p>
<p>Перейдите по ссылке для сброса пароля: {{ baseUrl }}{{ urlFor('password.reset') }}?email={{ user.email }}&identifier={{ identifier|url_encode }}</p>
{% endblock %}