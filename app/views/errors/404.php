{% extends 'templates/default.php' %}
{% block title %} 404 Страница не найдена {% endblock %}
{% block content %} Страницы не найдена <br><a href="{{ urlFor('home')}}"> На главную </a> {% endblock %}

