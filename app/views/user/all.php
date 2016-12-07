{% extends 'templates/default.php' %}
{% block title %} Список пользователей {% endblock %}
{% block content %}
<h2>Список пользователей</h2>

{% if users is empty %}

{% else %}
    {% for user in users %}
        <div class="user">
            <a href="{{ urlFor('user.profile', {uniq_identifier: user.uniq_identifier}) }}">{{ user.getFullNameOrUsername() }}</a>
            {% if user.getFullName() %}
                (   Логин: {{ user.username }}, ID={{ user.uniq_identifier }}, Место работы: {{ user.company }}, Должность: {{ user.person_office }}, Телефон: {{ user.phone_number }} )
            {% endif %}
            {% if user.isAdmin() %}
            (Admin)
            {% endif %}
        </div>
    {% endfor %}
{% endif %}

{% endblock %}

