{% extends 'admin/menu.php' %}
{% block title %} Редактировать тендер {% endblock %}
{% block content %}
<form class="form-horizontal" enctype="multipart/form-data" action="/admin/edit/{{ request.post('tender_identifier') ? request.post('tender_identifier') : tender.tender_number }}" method="post">
    <div class="form-group">
        <label for="tender_identifier" class="col-sm-2 control-label">Номер</label>
        <div class="col-sm-10">
            <input type="text" class="form-control disabled" id="tender_identifier" name="tender_identifier"
                   value="{{ request.post('tender_identifier') ? request.post('tender_identifier') : tender.tender_number }}">
        </div>
    </div>

    <div class="form-group">
        <label for="purchase_organizer" class="col-sm-2 control-label">Организатор закупки</label>
        <div class="col-sm-10">
            <select class="form-control" name="purchase_organizer" id="purchase_organizer">
                {% if tender.purchase_organizer %}
                <option value="{{ tender.purchase_organizer }}">{{ tender.purchase_organizer }}
                </option>
                {% endif %}
                <option value="НИПИ AIK-EKO">НИПИ AIK-EKO</option>
                <option value="AIK-EKO">AIK-EKO</option>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label for="purchase_category" class="col-sm-2 control-label">Категория закупки</label>
        <div class="col-sm-10">
            <select class="form-control" name="purchase_category" id="purchase_category">
                {% if tender.purchase_category %}
                <option value="{{ tender.purchase_category }}">{{ tender.purchase_category }}</option>
                {% endif %}
                <option value="Услуги">Услуги</option>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label for="product_category" class="col-sm-2 control-label">Категория продукции</label>
        <div class="col-sm-10">
            <select class="form-control" name="product_category" id="product_category">
                {% if tender.product_category %}
                <option value="{{ tender.product_category }}">{{ tender.product_category }}</option>
                {% endif %}
                <option value="Инженерные изыскания">Инженерные изыскания</option>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label for="purchase_description" class="col-sm-2 control-label">Краткое описание предмета закупки</label>
        <div class="col-sm-10">
            <textarea name="purchase_description" id="purchase_description" style="width:100%" rows="5">{{ request.post('purchase_description') ? request.post('purchase_description') : tender.purchase_description }}</textarea>
            {% if errors.has('purchase_description') %} {{ errors.first('purchase_description') }} {% endif %}
        </div>
    </div>

    <div class="form-group">
        <label for="start_date" class="col-sm-2 control-label">Начало сбора оферт</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="start_date" name="start_date" value="{{ request.post('start_date') ? request.post('start_date') : tender.start_date }}">
            {% if errors.has('start_date') %} {{ errors.first('start_date') }} {% endif %}
        </div>
    </div>

    <div class="form-group">
        <label for="end_date" class="col-sm-2 control-label">Окончание сбора оферт</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="end_date" name="end_date" value="{{ request.post('end_date') ? request.post('end_date') : tender.end_date }}">
            {% if errors.has('end_date') %} {{ errors.first('end_date') }} {% endif %}
        </div>
    </div>

    <div class="form-group">
        <label for="file_contents" class="col-sm-2 control-label">Добавить файл</label>

        <div class="col-sm-10">
            <input type="file" id="file_contents" name="file_contents">
            <a href="{{ tender.file_contents }}">Скачать для проверки существущий пакет документов</a>
            {% if file_error %} {{ file_error }} {% endif %}
            {% if errors.has('file_contents') %} {{ errors.first('file_contents') }} {% endif %}
            <input type="hidden" name="file_data" value="{{ tender.file_contents }}">
        </div>
    </div>

    <div class="form-group">
        <label for="update_reason" class="col-sm-2 control-label">Причина редактирования</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="update_reason" name="update_reason" value="{{ request.post('update_reason') ? request.post('update_reason') : tender.update_reason }}">
            {% if errors.has('update_reason') %} {{ errors.first('update_reason') }} {% endif %}
        </div>
    </div>

    <div class="form-group">
        <label for="winner" class="col-sm-2 control-label">Выбрать победителя</label>
        <div class="col-sm-10">
            <select class="form-control" name="winner" id="winner">
                <option value=""></option>
                {% for user in users %}
                <option value="{{ user.uniq_identifier }}">{{ user.company }}</option>
                {% endfor %}
            </select>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default btn-green">Обновить тендер</button>
        </div>
    </div>

    <input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">

</form>

<table class="table table-responsive table-bordered">
    <tr>
        <td>Компания</td>
        <td>Сумма</td>
        <td>Место</td>
        <td>Документы</td>
        <td>Исключить участника</td>
    </tr>
    {% for user in users %}
    <tr>
        <td><a href="{{ urlFor('user.profile', {uniq_identifier: user.uniq_identifier}) }}">{{ user.company }}</a></td>
        <td>{{ user.curent_price }}</td>
        <td>{{ user.curent_place }}</td>
        <td><a download href="{{ user.file_contents }}">Скачать</a></td>
        <td>
            <form action="{{ urlFor('admin.tender.edit.delete.post') }}" method="post">
                <input type="text" name="reasonDelete" id="reasonDelete" placeholder="Причина">
                <input type="hidden" name="userId" value="{{user.uniq_identifier}}">
                <input type="hidden" name="tenderId" value="{{tender.tender_number}}">
                <input type="submit" name="userDelete" value="Исключить">
                <input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">
            </form>
        </td>
    </tr>
    {% endfor %}
</table>
{% endblock %}

