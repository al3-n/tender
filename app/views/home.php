{% extends 'templates/default.php' %}
{% block title %} Главная страница {% endblock %}
{% block content %}
<h2 class="text-center">Добро пожаловать на тендерную площадку AIK-EKO</h2>
{% if tenders is empty %}

{% else %}
<div class="tender">
    <table id="tenders-list">
        <tr class="thead">
            <td>№ П/П</td>
            <td>Организатор</td>
            <td>Категория закупки</td>
            <td>Категория продукции</td>
            <td>Краткое описание</td>
            <td>Начало</td>
            <td>Окончание</td>
            <td>Переход</td>
        </tr>
        {% for tender in tenders %}
        <tr class="tbody">
            <td>{{ tender.tender_number }}</td>
            <td>{{ tender.purchase_organizer }}</td>
            <td>{{ tender.purchase_category }}</td>
            <td>{{ tender.product_category }}</td>
            <td>{{ tender.purchase_description }}</td>
            <td>{{ tender.start_date }}</td>
            <td>{{ tender.end_date }}</td>
            <td><a data-toggle="tooltip" data-placement="bottom" title="Для участия в тендере необходимо авторизироваться" href="/tenders/tender-view/{{ tender.tender_number }}"><img src="assets/images/diskette.png" alt=""></a></td>
        </tr>
        {% endfor %}
    </table>
</div>

<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
{% endif %}
{% endblock %}

