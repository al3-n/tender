{% extends 'admin/menu.php' %}
{% block title %} Добавить тендер {% endblock %}
{% block content %}
<form class="form-horizontal" enctype="multipart/form-data" action="{{ urlFor('admin.tender.post') }}" method="post">
    <div class="form-group">
        <label for="tender_identifier" class="col-sm-2 control-label">Номер</label>
        <div class="col-sm-10">
            <input type="text" class="form-control disabled" id="tender_identifier" name="tender_identifier"
                   {% if tender_number %} value="{{tender_number}}" {% endif %} {% if request.post('tender_identifier')
            %}value="{{request.post('tender_identifier')}}"{% endif %}>
        </div>
    </div>

    <div class="form-group">
        <label for="purchase_organizer" class="col-sm-2 control-label">Организатор закупки</label>
        <div class="col-sm-10">
            <select class="form-control" name="purchase_organizer" id="purchase_organizer">
                {% if request.post('purchase_organizer') %}
                <option value="{{ request.post('purchase_organizer') }}">{{ request.post('purchase_organizer') }}
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
                {% if request.post('purchase_category') %}
                <option value="{{ request.post('purchase_category') }}">{{ request.post('purchase_category') }}</option>
                {% endif %}
                <option value="Услуги">Услуги</option>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label for="product_category" class="col-sm-2 control-label">Категория продукции</label>
        <div class="col-sm-10">
            <select class="form-control" name="product_category" id="product_category">
                {% if request.post('product_category') %}
                <option value="{{ request.post('product_category') }}">{{ request.post('product_category') }}</option>
                {% endif %}
                <option value="Инженерные изыскания">Инженерные изыскания</option>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label for="purchase_description" class="col-sm-2 control-label">Краткое описание предмета закупки</label>
        <div class="col-sm-10">
            <textarea name="purchase_description" id="purchase_description" style="width:100%" rows="5">{% if request.post('purchase_description') %}{{request.post('purchase_description')}}{% endif %}</textarea>
            {% if errors.has('purchase_description') %} {{ errors.first('purchase_description') }} {% endif %}
        </div>
    </div>

    <div class="form-group">
        <label for="start_date" class="col-sm-2 control-label">Начало сбора оферт</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="start_date" name="start_date" {% if request.post('start_date')
            %}value="{{request.post('start_date')}}" {% endif %}>
            {% if errors.has('start_date') %} {{ errors.first('start_date') }} {% endif %}
        </div>
    </div>

    <div class="form-group">
        <label for="end_date" class="col-sm-2 control-label">Окончание сбора оферт</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="end_date" name="end_date" {% if request.post('end_date')
            %}value="{{request.post('end_date')}}" {% endif %}>
            {% if errors.has('end_date') %} {{ errors.first('end_date') }} {% endif %}
        </div>
    </div>

    <div class="form-group">
        <label for="file_contents" class="col-sm-2 control-label">Добавить файл</label>
        <div class="col-sm-10">
            <input type="file" id="file_contents" name="file_contents">
            {% if file_error %} {{ file_error }} {% endif %}
            {% if errors.has('file_contents') %} {{ errors.first('file_contents') }} {% endif %}
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default btn-green">Зарегистрировать тендер</button>
        </div>
    </div>

    <input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">

</form>
{% endblock %}

