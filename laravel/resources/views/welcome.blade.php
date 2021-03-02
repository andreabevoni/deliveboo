<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <style>
        html,
        body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

            .m-b-md {
                margin-bottom: 30px;
            }


            /* css custom */
            .typologies {
              margin: 20px auto;
              width: 1000px;
              color: red;
              display: flex;
              justify-content: space-between;
            }

            .typologies span:hover {
              cursor: pointer;
            }

            .search {
              margin: 20px auto;
              width: 1000px;
              display: flex;
              flex-wrap: wrap;
              justify-content: center;
              align-items: center;
            }

            .user {
              width: 100px;
              height: 100px;
              margin: 20px;
              padding: 10px;
              border: 2px solid blue;
              display: flex;
              justify-content: center;
              align-items: center;
            }
        </style>

        <script src="{{asset('js/app.js')}}" charset="utf-8"></script>
    </head>

        .m-b-md {
            margin-bottom: 30px;
        }

            <div class="content">
                <div class="title m-b-md">
                    Deliveboo
                </div>

<body>
    <div class="flex-center position-ref full-height">
        @if (Route::has('login'))
            <div class="top-right links">
                @auth
                    <a href="{{ url('/dashboard') }}">DASHBOARD</a>
                    <a href="{{ url('/home') }}">HOME</a>
                @else
                    <a href="{{ route('login') }}">Login</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">Register</a>
                    @endif
                @endauth
                <div class="">
                  Clicca su una categoria per trovare ristoranti nella tua zona.
                </div>

                <search
                  :typologies="{{json_encode($typologies)}}"
                ></search>
            </div>
        @endif

        <div class="content">
            <div class="title m-b-md">
                DeliveBoo
            </div>

            <div class="links">
                <a href="https://laravel.com/docs">Docs</a>
                <a href="https://laracasts.com">Laracasts</a>
                <a href="https://laravel-news.com">News</a>
                <a href="https://blog.laravel.com">Blog</a>
                <a href="https://nova.laravel.com">Nova</a>
                <a href="https://forge.laravel.com">Forge</a>
                <a href="https://vapor.laravel.com">Vapor</a>
                <a href="https://github.com/laravel/laravel">GitHub</a>
            </div>
        </div>
    </div>
</body>

</html>
