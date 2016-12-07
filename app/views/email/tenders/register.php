{% extends 'email/templates/default.php' %}

{% block content %}
<p>Уважаемый, {{ user.first_name }} {{ user.last_name }}, Вы подали заявку на участие в тендере №{{ tender.tender_number }}.</p>
<p>Завершение данного тендера произойдет {{ tender.end_date }}.</p>
{% endblock %}