<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel-Shop</title>

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
            <a class="navbar-brand" href="{{ route('home') }}">Shop</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="{{ route('home') }}">All products</a></li>
                <li><a href="{{ route('shop.categories.index') }}">Categories</a></li>
                <li><a href="{{ route('cart') }}">Cart</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @auth
                    @admin
                        <li><a href="{{ route('admin.orders.index') }}">Administrator panel</a></li>
                    @else
                        <li><a href="{{ route('user.orders.index') }}">User panel</a></li>
                    @endadmin
                    <li><a href="" onclick="event.preventDefault();
                                 document.getElementById('logout').submit();">
                        Logout
                        </a></li>
                    <form class="d-none" id="logout" action="{{ route('logout') }}" method="POST">
                        @csrf
                    </form>
                @else
                    <li><a href="{{ route('login') }}">Login</a></li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    @yield('content')
</div>
</body>
</html>


