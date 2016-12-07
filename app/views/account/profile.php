{% extends 'account/menu.php' %}
{% block title %} Личный профиль {% endblock %}
{% block content %}
<div>
    <form class="form-horizontal" action="{{ urlFor('account.profile.post') }}" method="post">
        <div class="form-group">
            <label for="email" class="col-sm-3 control-label">Email</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="email" name="email"
                       value="{{ request.post('email') ? request.post('email') : auth.email }}">
                {% if errors.has('email') %} {{ errors.first('email') }} {% endif %}
            </div>
        </div>
        <div class="form-group">
            <label for="first_name" class="col-sm-3 control-label">Имя</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="first_name" name="first_name"
                       value="{{ request.post('first_name') ? request.post('first_name') : auth.first_name }}">
                {% if errors.has('first_name') %} {{ errors.first('first_name') }} {% endif %}
            </div>
        </div>

        <div class="form-group">
            <label for="last_name" class="col-sm-3 control-label">Фамилия</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="last_name" name="last_name"
                       value="{{ request.post('last_name') ? request.post('last_name') : auth.last_name }}">
                {% if errors.has('last_name') %} {{ errors.first('last_name') }} {% endif %}
            </div>
        </div>

        <div class="form-group">
            <label for="company" class="col-sm-3 control-label">Компания</label>
            <div class="col-sm-4">
                <input type="text" name="company" id="company" class="form-control"
                       value="{{ request.post('company') ? request.post('company') : auth.company}}">
                {% if errors.has('company') %} {{errors.first('company')}} {% endif %}
            </div>
        </div>

        <div class="form-group">
            <label for="juro_address" class="col-sm-3 control-label">Юридический адрес</label>
            <div class="col-sm-4">
                <input type="text" name="juro_address" id="juro_address" class="form-control"
                       value="{{ request.post('juro_address') ? request.post('juro_address') : auth.juro_address }}">
                {% if errors.has('juro_address') %} {{errors.first('juro_address')}} {% endif %}
            </div>
        </div>

        <div class="form-group">
            <label for="post_address" class="col-sm-3 control-label">Почтовый адрес</label>
            <div class="col-sm-4">
                <input type="text" name="post_address" id="post_address" class="form-control"
                       value="{{ request.post('post_address') ? request.post('post_address') : auth.post_address }}">
                {% if errors.has('post_address') %} {{errors.first('post_address')}} {% endif %}
            </div>
        </div>

        <div class="form-group">
            <label for="office" class="col-sm-3 control-label">Должность</label>
            <div class="col-sm-4">
                <input type="text" name="office" id="office" class="form-control"
                       value="{{ request.post('office') ? request.post('office') : auth.person_office }}">
                {% if errors.has('office') %} {{errors.first('office')}} {% endif %}
            </div>
        </div>

        <div class="form-group">
            <label for="phone_number" class="col-sm-3 control-label">Номер телефона</label>
            <div class="col-sm-4">
                <input type="tel" name="phone_number" id="phone_number" class="form-control"
                       value="{{ request.post('phone_number') ? request.post('phone_number') : auth.phone_number }}">
                {% if errors.has('phone_number') %} {{errors.first('phone_number')}} {% endif %}
            </div>
        </div>

        <div class="form-group">
            <label for="egrpou" class="col-sm-3 control-label">ЕГРПОУ (Украина), ЕГРЮЛ (РФ), <br>№ единого
                гос.реестра
                предприятий (для других госсударств)</label>
            <div class="col-sm-4">
                <input type="text" name="egrpou" id="egrpou" class="form-control"
                       value="{{ request.post('egrpou') ? request.post('egrpou') : auth.egrpou }}">
                {% if errors.has('egrpou') %} {{errors.first('egrpou')}} {% endif %}
            </div>
        </div>

        <div class="form-group">
            <label for="iso9001" class="col-sm-3 control-label">Наличие сертификата ISO 9001</label>
            <div class="col-sm-4">
                <input type="radio" id="iso9001" name="iso9001" id="iso9001" value="0" checked> Нет
                <input type="radio" id="iso9001" name="iso9001" id="iso9001" value="1"> Да
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-10">
                <button type="submit" class="btn btn-default btn-green">Изменить</button>
            </div>
        </div>
        <input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">
    </form>
</div>
</div>
</section>
</div>
{% endblock %}

