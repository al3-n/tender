{% extends 'account/menu.php' %}
{% block title %} Список тендеров {% endblock %}
{% block content %}
<div class="panel-group" id="collapse-group">
    {% if active_tender is empty %}
    Нет активных тендеров
    {% else %}

    {% for tender in active_tender %}
    <div id="panel" class="panel panel-default">
        <div class="panel-heading active">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#collapse-group" href="#{{ tender.tender_number }}">{{
                    tender.tender_number }} {{ tender.end_date }}</a>
            </h4>
        </div>
        <div id="{{ tender.tender_number }}" class="panel-collapse collapse in">
            <div class="panel-body">
                <table id="tenders" class="table table-bordered">
                    <tr>
                        <td class="first">Организатор закупки</td>
                        <td>{{ tender.purchase_organizer }}</td>
                    </tr>
                    <tr>
                        <td class="first">Категория закупки</td>
                        <td>{{ tender.purchase_category }}</td>
                    </tr>
                    <tr>
                        <td class="first">Категория продукции</td>
                        <td>{{ tender.product_category }}</td>
                    </tr>
                    <tr>
                        <td class="first">Краткое описание</td>
                        <td>{{ tender.purchase_description }}</td>
                    </tr>
                    <tr>
                        <td class="first">Начало сбора оферт</td>
                        <td>{{ tender.start_date }}</td>
                    </tr>
                    <tr>
                        <td class="first">Окончание</td>
                        <td>{{ tender.end_date }}</td>
                    </tr>
                </table>
            </div>
            <div class="panel-footer tender-footer">

                <form action="{{ urlFor('account.tenders.post') }}" method="post">
                    Ваша ставка: <input type="text" name="price" id="price" value="{{ place.price }}">
                    {% if errors.has('price') %} {{errors.first('price')}} {% endif %}
                    <input type="submit" value="Изменить">
                    Ваше место: {{ place.place }}
                    <input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">
                </form>
            </div>
        </div>
    </div>
    {% endfor %}
    {% endif %}

    {% for tender in all_tenders %}
    <div id="panel" class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#collapse-group" href="#{{ tender.tender_number }}">{{
                    tender.tender_number }} {{ tender.end_date }} </a>
                <span class="winner-info">{% if tender.winner == auth.uniq_identifier %} Вы победили в этом тендере {% else %} Вы проиграли в этом тендере {% endif %}</span>
            </h4>
        </div>
        <div id="{{ tender.tender_number }}" class="panel-collapse collapse">
            <div class="panel-body">
                <table id="tenders" class="table table-bordered">
                    <tr>
                        <td class="first">Организатор закупки</td>
                        <td>{{ tender.purchase_organizer }}</td>
                    </tr>
                    <tr>
                        <td class="first">Категория закупки</td>
                        <td>{{ tender.purchase_category }}</td>
                    </tr>
                    <tr>
                        <td class="first">Категория продукции</td>
                        <td>{{ tender.product_category }}</td>
                    </tr>
                    <tr>
                        <td class="first">Краткое описание</td>
                        <td>{{ tender.purchase_description }}</td>
                    </tr>
                    <tr>
                        <td class="first">Начало сбора оферт</td>
                        <td>{{ tender.start_date }}</td>
                    </tr>
                    <tr>
                        <td class="first">Окончание</td>
                        <td>{{ tender.end_date }}</td>
                    </tr>
                </table>

                <div class="tender-footer">{{ reg.curent_price }}</div>
            </div>
        </div>
    </div>
    {% endfor %}
</div>
</div>
</section>
</div>
{% endblock %}

