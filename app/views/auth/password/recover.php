{% extends 'templates/default.php' %}
{% block title %} Восстановление пароля {% endblock %}
{% block content %}


<div class="text-center">
    <h2>Восстановление доступа</h2>
    <form class="form-inline" action="{{ urlFor('password.recover.post') }}" method="post" >
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" {% if request.post('email') %} value="{{ request.post('email') }}" {% endif %}>
            {% if errors.has('email') %} {{ errors.first('email') }} {% endif %}
        </div>
        <button type="submit" class="btn btn-default btn-green">Отправить письмо</button>
        <input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">
    </form>
</div>
{% endblock %}

