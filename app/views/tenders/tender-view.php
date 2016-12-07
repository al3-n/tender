{% extends 'templates/default.php' %}
{% block title %} Информация о тендере №{{ tender.tender_number }} {% endblock %}
{% block content %}
{% if tender is empty %}

{% else %}


<div id="top-area">

    <table id="tenders" class="table table-bordered table-hover table-responsive">
        <tr>
            <td class="first">Номер тендера</td>
            <td class="second">{{ tender.tender_number }}</td>
        </tr>
        <tr>
            <td class="first">Организатор закупки</td>
            <td class="second">{{ tender.purchase_organizer }}</td>
        </tr>
        <tr>
            <td class="first">Категория закупки</td>
            <td class="second">{{ tender.purchase_category }}</td>
        </tr>
        <tr>
            <td class="first">Категория продукции</td>
            <td class="second">{{ tender.product_category }}</td>
        </tr>
        <tr>
            <td>Краткое описание предмета закупки</td>
            <td>{{ tender.purchase_description }}</td>
        </tr>
        <tr>
            <td class="first">Начало сбора оферт</td>
            <td class="second">{{ tender.start_date }}</td>
        </tr>
        <tr>
            <td class="first">Окончание сбора оферт</td>
            <td class="second">{{ tender.end_date }}</td>
        </tr>
    </table>

    <div class="bottom-area">
        <form class="form-horizontal" enctype="multipart/form-data" action="/tenders/tender-view/{{ tender.tender_number }}" method="post">
            <div class="form-group">
                <label for="file_contents" class="col-sm-2 control-label">Загрузить документы</label>
                <div class="col-sm-10">
                    {% if auth %}

                        {% if error %}
                            {{ error }}
                        {% else %}
                            <input type="file" id="file_contents" name="file_contents">
                            <input type="hidden" name="tender" value="{{ tender.tender_number }}">
                            {% if file_error %} {{ file_error }} {% endif %}
                            {% if errors.has('file_contents') %} {{ errors.first('file_contents') }} {% endif %}
                        {% endif %}

                    {% else %}
                            Чтобы сделать предложение, авторизируйтесь
                            <a class="btn btn-default btn-green" href="{{ urlFor('login') }}">Войти</a>
                            <a class="btn btn-default btn-green" href="{{ urlFor('register') }}">Регистрация</a>

                    {% endif %}
                </div>
            </div>

            <div class="form-group">
                <label for="summ" class="col-sm-2 control-label">Сумма</label>

                {% if error %}
                Вы можете изменить сумму в личном кабинете.
                {% else %}
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="summ" name="summ" placeholder="Значение необходимо указывать в USD. Заявленную сумму возможно изменить в личном кабинете"
                           value="{{ request.post('summ') ? request.post('summ') : tender.summ }}">
                    {% if errors.has('summ') %} {{ errors.first('summ') }} {% endif %}
                </div>
                {% endif %}
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    {% if auth %}
                        {% if error %}

                        {% else %}
                        <button type="submit" class="btn btn-default btn-green">Участвовать в тендере</button>
                        {% endif %}
                    {% endif %}
                </div>
            </div>

            <input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">
        </form>
    </div>
    {% endif %}
    {% endblock %}

