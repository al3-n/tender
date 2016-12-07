{% extends 'templates/default.php' %}
{% block title %} Авторизация {% endblock %}
{% block content %}

<h2 class="text-center">Авторизация</h2>

<form class="form-horizontal" action="{{ urlFor('login.post') }}" method="post">

    <div class="form-group">
        <label for="identifier" class="col-sm-offset-2 col-sm-2 control-label">Логин / email</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" name="identifier" id="identifier" {% if request.post('identifier')%}
            value="{{
            request.post('identifier') }}" {% endif %}>
            {% if errors.first('identifier') %} {{ errors.first('identifier') }} {% endif %}
        </div>
    </div>

    <div class="form-group">
        <label for="password" class="col-sm-offset-2 col-sm-2 control-label">Пароль</label>
        <div class="col-sm-4">
            <input type="password" class="form-control" name="password" id="password">
            {% if errors.first('password') %} {{ errors.first('password') }} {% endif %}
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-4 col-sm-10">
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="remember" id="remember"> Запомнить меня
                </label>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-4 col-sm-5">
            <button type="submit" class="btn btn-default btn-green">Войти</button>
            <a href="{{ urlFor('password.recover') }}" class="btn btn-default btn-info">Восстановить пароль</a>
        </div>
    </div>
    <input type="hidden" name="referer" value="{{ referer }}">
    <input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">

</form>

{% endblock %}

