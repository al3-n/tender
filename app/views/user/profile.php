{% extends 'templates/default.php' %}
{% block title %} {{ user.getFullNameOrUsername() }} {% endblock %}
{% block content %}
<h2>{{ user.username }}</h2>
<table class="table table-bordered">
    <tr>
        <td>ФИО</td>
        <td>{{ user.getFullNameOrUsername() }}</td>
    </tr>
    <tr>
        <td>Email</td>
        <td>{{ user.email }}</td>
    </tr>
    <tr>
        <td>Компания</td>
        <td>{{ user.company }}</td>
    </tr>
    <tr>
        <td>Должность</td>
        <td>{{ user.person_office }}</td>
    </tr>
    <tr>
        <td>Телефон</td>
        <td>{{ user.phone_number }}</td>
    </tr>
</table>
{% endblock %}

