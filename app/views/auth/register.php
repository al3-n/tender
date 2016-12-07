{% extends 'templates/default.php' %}
{% block title %}
Регистрация
{% endblock %}

{% block content %}

<h2 class="text-center">Регистрация</h2>

<form class="form-horizontal" action="{{ urlFor('register.post') }}" method="post" autocomplete="off">
    <div class="form-group">
        <label for="email" class="col-sm-offset-1 col-sm-3 control-label">Email</label>
        <div class="col-sm-5">
            <input type="email" name="email" id="email" class="form-control" {% if request.post('email') %}
            value="{{request.post('email')}}" {% endif %}>
            {% if errors.has('email') %} {{errors.first('email')}} {% endif %}
        </div>
    </div>

    <div class="form-group">
        <label for="username" class="col-sm-offset-1 col-sm-3 control-label">Логин</label>
        <div class="col-sm-5">
            <input type="text" name="username" id="username" class="form-control" {% if request.post('username') %}
            value="{{request.post('username')}}" {% endif %}>
            {% if errors.has('username') %} {{errors.first('username')}} {% endif %}
        </div>
    </div>

    <div class="form-group">
        <label for="first_name" class="col-sm-offset-1 col-sm-3 control-label">Имя</label>
        <div class="col-sm-5">
            <input type="text" name="first_name" id="first_name" class="form-control" {% if request.post('first_name')
            %}
            value="{{request.post('first_name')}}" {% endif %}>
            {% if errors.has('first_name') %} {{errors.first('first_name')}} {% endif %}
        </div>
    </div>

    <div class="form-group">
        <label for="last_name" class="col-sm-offset-1 col-sm-3 control-label">Фамилия</label>
        <div class="col-sm-5">
            <input type="text" name="last_name" id="last_name" class="form-control" {% if request.post('last_name') %}
            value="{{request.post('last_name')}}" {% endif %}>
            {% if errors.has('last_name') %} {{errors.first('last_name')}} {% endif %}
        </div>
    </div>

    <div class="form-group">
        <label for="password" class="col-sm-offset-1 col-sm-3 control-label">Пароль</label>
        <div class="col-sm-5">
            <input type="password" name="password" id="password" class="form-control">
            {% if errors.has('password') %} {{errors.first('password')}} {% endif %}
        </div>
    </div>

    <div class="form-group">
        <label for="password_confirm" class="col-sm-offset-1 col-sm-3 control-label">Подвтердите пароль</label>
        <div class="col-sm-5">
            <input type="password" name="password_confirm" id="password_confirm" class="form-control">
            {% if errors.has('password_confirm') %} {{errors.first('password_confirm')}} {% endif %}
        </div>
    </div>


    <div class="form-group">
        <label for="company_name" class="col-sm-offset-1 col-sm-3 control-label">Компания</label>
        <div class="col-sm-5">
            <input type="text" name="company_name" id="company_name" class="form-control" {% if request.post('company_name')
            %}
            value="{{request.post('company_name')}}" {% endif %}>
            {% if errors.has('company_name') %} {{errors.first('company_name')}} {% endif %}
        </div>
    </div>

    <div class="form-group">
        <label for="juro_address" class="col-sm-offset-1 col-sm-3 control-label">Юридический адрес</label>
        <div class="col-sm-5">
            <input type="text" name="juro_address" id="juro_address" class="form-control" {% if request.post('juro_address')
            %}
            value="{{request.post('juro_address')}}" {% endif %}>
            {% if errors.has('juro_address') %} {{errors.first('juro_address')}} {% endif %}
        </div>
    </div>

    <div class="form-group">
        <label for="post_address" class="col-sm-offset-1 col-sm-3 control-label">Почтовый адрес</label>
        <div class="col-sm-5">
            <input type="text" name="post_address" id="post_address" class="form-control" {% if request.post('post_address')
            %}
            value="{{request.post('post_address')}}" {% endif %}>
            {% if errors.has('post_address') %} {{errors.first('post_address')}} {% endif %}
        </div>
    </div>

    <div class="form-group">
        <label for="office" class="col-sm-offset-1 col-sm-3 control-label">Должность</label>
        <div class="col-sm-5">
            <input type="text" name="office" id="office" class="form-control" {% if request.post('office') %}
            value="{{request.post('office')}}" {% endif %}>
            {% if errors.has('office') %} {{errors.first('office')}} {% endif %}
        </div>
    </div>

    <div class="form-group">
        <label for="phone_number" class="col-sm-offset-1 col-sm-3 control-label">Номер телефона</label>
        <div class="col-sm-5">
            <input type="tel" name="phone_number" id="phone_number" class="form-control" {% if request.post('phone_number')
            %}
            value="{{request.post('phone_number')}}" {% endif %}>
            {% if errors.has('phone_number') %} {{errors.first('phone_number')}} {% endif %}
        </div>
    </div>

    <div class="form-group">
        <label for="egrpou" class="col-sm-offset-1 col-sm-3 control-label">ЕГРПОУ (Украина), ЕГРЮЛ (РФ), <br>№ единого
            гос.реестра
            предприятий (для других госсударств)</label>
        <div class="col-sm-5">
            <input type="text" name="egrpou" id="egrpou" class="form-control" {% if request.post('egrpou') %}
            value="{{request.post('egrpou')}}" {% endif %}>
            {% if errors.has('egrpou') %} {{errors.first('egrpou')}} {% endif %}
        </div>
    </div>
    <div class="form-group">
        <label for="iso9001" class="col-sm-offset-1 col-sm-3 control-label">Наличие сертификата ISO 9001</label>
        <div class="col-sm-5">
            <input type="radio" id="iso9001" name="iso9001" id="iso9001" value="0" checked> Нет
            <input type="radio" id="iso9001" name="iso9001" id="iso9001" value="1"> Да
        </div>
    </div>

    <div class="form-group">
        <label for="iso9001" class="col-sm-offset-1 col-sm-3 control-label"></label>
        <div class="col-sm-5">
            <input type="submit" class="btn btn-default btn-green" value="Зарегистрироваться">
        </div>
    </div>
    <input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">
</form>

{% endblock %}