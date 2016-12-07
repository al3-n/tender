<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AIK-EKO Tender | {% block title %}{% endblock %}</title>
    <link href="{{ baseUrl }}/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ baseUrl }}/assets/js/script.js" rel="stylesheet">
    <link href="{{ baseUrl }}/assets/css/style.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.1.1.slim.js"
            integrity="sha256-5i/mQ300M779N2OVDrl16lbohwXNUdzL/R2aVUXyXWA=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $( function() {
            $( "#start_date" ).datepicker({
                changeMonth: true,
                changeYear: true,
                dateFormat: 'yy-mm-dd'
            });
        } );

        $( function() {
            $( "#end_date" ).datepicker({
                changeMonth: true,
                changeYear: true,
                dateFormat: 'yy-mm-dd'
            });
        } );
    </script>
</head>
<body>

<header>
    <div class="container">
        {% include 'templates/partials/navigation.php' %}
    </div>
</header>
<section id="content">
    <div class="container">
        <div class="container-fluid">
            <section class="tab-content">
                <div class="col-md-12 col-sm-12 col-lg-3 right-side">
                    <div class="right_menu">
                        <ul style="padding-left: 0;">
                            <li onclick="location.href='{{ urlFor('admin.tender') }}'">
                                <a href="{{ urlFor('admin.tender') }}">
                                    <span>Добавить тендер</span>
                                </a>
                            </li>
                            <li onclick="location.href='{{ urlFor("admin.tenders") }}'">
                                <a href="{{ urlFor('admin.tenders') }}">
                                    Список тендеров
                                </a>
                            </li>
                            <li onclick="location.href='{% if tender.tender_number %} /admin/edit/{{tender.tender_number}} {% else %} # {% endif %}'">
                                <a href="{% if tender.tender_number %} /admin/edit/{{tender.tender_number}} {% else %} # {% endif %}">
                                    Редактировать тендер
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-12 col-lg-9 col-sm-12 techno-content">
                    {% include 'templates/partials/messages.php' %}
                    {% block content %} {% endblock %}

    </div>
</section>

<script src="{{ baseUrl }}/assets/js/bootstrap.min.js"></script>
            <script>
                $('div.right_menu li').each(function() {
                    if (this.getElementsByTagName("a")[0].href == location.href)
                        this.className = "active";
                });
            </script>
</body>
</html>