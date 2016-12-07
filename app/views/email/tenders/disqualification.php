{% extends 'email/templates/default.php' %}

{% block content %}
<p>Уважаемый, {{ user.first_name }} {{ user.last_name }}, Вас исключили из участия в тендере №{{ tender.tender_number }} по причине: {{ reasonDelete }}.</p>
{% endblock %}