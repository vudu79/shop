<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Интернет Магазин</title>

    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>

    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/starter-template.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="http://laravel-diplom-1.rdavydov.ru">Интернет Магазин</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li @routeactive(
                'main')><a href="{{ route('main') }}">Все товары</a></li>
                <li @routeactive(
                'categories')><a href="{{ route('categories') }}">Категории</a>
                </li>
                <li @routeactive(
                'basket')><a href="{{ route('basket') }}">В корзину</a></li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false">{{ \App\Services\ConvertCurrency::getCurrencySimbol()}}<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        @foreach(\App\Services\ConvertCurrency::getCurrencies() as $currency)
                            <li><a href="{{ route('currency', $currency->code) }}">{{ $currency->simbol }}</a></li>
                        @endforeach
                    </ul>
                </li>

            </ul>


            @auth()
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="{{ route('get-logout') }}">{{ isset(auth()->user()->name) ? auth()->user()->name :'' }}</a>
                    </li>
                </ul>
                @admin
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="{{ route('home') }}">Панель администратора</a></li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <li><a href="{{ route('reset') }}">Вернуть сайт в исходное состояние</a></li>
                </ul>

            @else
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="{{ route('person.order.index') }}">Мои заказы</a></li>
                </ul>
                @endadmin

                <ul class="nav navbar-nav navbar-right">
                    <li><a href="{{ route('get-logout') }}">Выйти</a></li>
                </ul>

            @endauth
            @guest()
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="{{ route('login') }}">Войти</a></li>
                </ul>
            @endguest


        </div>
    </div>
</nav>


<div class="container d-flex justify-content-center">
    <div class="starter-template">
        @if(session()->has('success'))
            <p class="alert alert-success">{{ session()->get('success') }}</p>
        @elseif(session()->has('danger'))
            <p class="alert alert-danger">{{ session()->get('danger') }}</p>
        @elseif(session()->has('emptybasket'))
            <p class="alert alert-danger">{{ session()->get('emptybasket') }}</p>
        @endif

        @yield('content')

    </div>
</div>

</body>
</html>

