{% extends 'templates/default.php' %}
{% block title %} Восстановление пароля {% endblock %}
{% block content %}

<div class="text-center">
    <h2>Регистрация нового пароля</h2>
    <form class="form-horizontal" action="{{ urlFor('password.reset.post') }}?email={{ email }}&identifier={{ identifier|url_encode }}" method="post">
        <div class="form-group">
            <label for="password" class="col-sm-offset-2 col-sm-2 control-label">Введите пароль</label>
            <div class="col-sm-4">
                <input type="password" class="form-control" name="password" id="password">
                {% if errors.has('password') %} {{ errors.first('password') }} {% endif %}
            </div>
        </div>

        <div class="form-group">
            <label for="password_confirm" class="col-sm-offset-2 col-sm-2 control-label">Повторите пароль</label>
            <div class="col-sm-4">
                <input type="password" class="form-control" name="password_confirm" id="password_confirm">
                {% if errors.has('password_confirm') %} {{ errors.first('password_confirm') }} {% endif %}
            </div>
        </div>

        <div class="form-group">
                <button type="submit" class="btn btn-default btn-green">Создать новый пароль</button>
        </div>
        <input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">
    </form>
</div>
{% endblock %}

