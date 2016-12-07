<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AIK-EKO Tender | {% block title %}{% endblock %}</title>
    <link href="{{ baseUrl }}/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ baseUrl }}/assets/css/style.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.1.1.slim.js"
            integrity="sha256-5i/mQ300M779N2OVDrl16lbohwXNUdzL/R2aVUXyXWA=" crossorigin="anonymous"></script>
</head>
<body>

<header>
    <div class="container">
        {% include 'templates/partials/navigation.php' %}
        {% include 'templates/partials/messages.php' %}
    </div>
</header>
<section id="content">
    <div class="container">
        <div class="row">
            {% block content %} {% endblock %}
        </div>
    </div>
</section>

<script src="{{ baseUrl }}/assets/js/bootstrap.min.js"></script>
</body>
</html>