<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="{{ urlFor('home') }}">Главная</a></li>
                {% if auth %}

                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false">{{ auth.getFullNameOrUsername() }} <span class="caret"></span></a>
                        <ul class="dropdown-menu">

                            {% if auth.isAdmin() %}
                            <li><a href="{{ urlFor('admin.tender') }}">Админка</a></li>
                            <li><a href="{{ urlFor('user.all') }}">Список пользователей</a></li>
<!--                            <li><a href="{{ urlFor('user.profile', {username: auth.username}) }}">Мой профиль</a></li>-->

                            {% endif %}

                            <li><a href="{{ urlFor('account.profile') }}">Мой профиль</a></li>
                            <li><a href="{{ urlFor('logout') }}">Выйти</a></li>
                        </ul>
                    </li>
                </ul>

                {% else %}

                <li><a href="{{ urlFor('register') }}">Регистрация</a></li>
                <li><a href="{{ urlFor('login') }}">Войти</a></li>


                {% endif %}

        </div>
    </div>
</nav>


