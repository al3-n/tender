{% extends 'email/templates/default.php' %}

{% block content %}
<p>Вы успешно зарегистрировались на тендерной площадке AIK-EKO</p>
<p>Для активации аккаунта перейдите по ссылке: <a href="{{ baseUrl }}{{ urlFor('activate') }}?email={{ user.email }}&identifier={{ identifier|url_encode }}">Активация аккаунта</a></p>
{% endblock %}