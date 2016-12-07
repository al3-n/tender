{% extends 'account/menu.php' %}
{% block title %} Смена пароля {% endblock %}
{% block content %}

<form action="{{ urlFor('password.change.post') }}" method="post">
    <div class="form-group">
        <label for="old_password">Старый пароль</label>
        <input type="password" class="form-control" name="old_password" id="old_password">
        {% if errors.has('old_password') %} {{ errors.first('old_password') }} {% endif %}
    </div>
    <div class="form-group">
        <label for="password">Введите новый пароль</label>
        <input type="password" class="form-control" name="password" id="password">
        {% if errors.has('password') %} {{ errors.first('password') }} {% endif %}
    </div>
    <div class="form-group">
        <label for="password_confirm">Повторите пароль</label>
        <input type="password" class="form-control" name="password_confirm" id="password_confirm">
        {% if errors.has('password_confirm') %} {{ errors.first('password_confirm') }} {% endif %}
    </div>
    <button type="submit" class="btn btn-default btn-green">Изменить пароль</button>
    <input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">
</form>

</div>
</section>
</div>
{% endblock %}

