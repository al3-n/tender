{% extends 'admin/menu.php' %}
{% block title %} Добавить тендер {% endblock %}
{% block content %}
{% if tenders is empty %}

{% else %}

<div class="tender">
    <table id="tenders-list">
        <tr class="thead">
            <td>id</td>
            <td>Организатор</td>
            <td>Категория закупки</td>
            <td>Категория продукции</td>
            <td>Начало</td>
            <td>Окончание</td>
            <td>Участников</td>
        </tr>
        {% for tender in tenders %}
        <tr class="tbody">
            <td><a href="/admin/edit/{{ tender.tender_number }}">{{ tender.tender_number }}</a></td>
            <td>{{ tender.purchase_organizer }}</td>
            <td>{{ tender.purchase_category }}</td>
            <td>{{ tender.product_category }}</td>
            <td>{{ tender.start_date }}</td>
            <td>{{ tender.end_date }}</td>
            <td>{{ tender.count_members }}</td>
        </tr>
        {% endfor %}
    </table>
</div>


{% endif %}
{% endblock %}

