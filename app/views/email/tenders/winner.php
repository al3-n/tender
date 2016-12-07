{% extends 'email/templates/default.php' %}

{% block content %}
<p>Уважаемый, {{ user.first_name }} {{ user.last_name }}, поздравляем! Вы одержали победу в тендере №{{ tender }}.</p>
<p>Наш представитель свяжется с вами в ближайшее время.</p>
{% endblock %}