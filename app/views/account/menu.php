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
                            <li onclick="location.href='{{ urlFor('account.tenders') }}'">
                                <a href="{{ urlFor('account.tenders') }}">
                                    <span>Информация по тендеру</span>
                                </a>
                            </li>
                            <li onclick="location.href='{{ urlFor("account.profile") }}'">
                                <a href="{{ urlFor('account.profile') }}">
                                    Личные данные
                                </a>
                            </li>
                            <li onclick="location.href='{{ urlFor("password.change") }}'">
                                <a href="{{ urlFor("password.change") }}">
                                    Изменить пароль
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