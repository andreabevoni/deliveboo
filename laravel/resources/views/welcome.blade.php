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

        .links>a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
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

        .m-b-md {
            margin-bottom: 30px;
        }

    </style>

    <script src="{{ asset('js/app.js') }}" charset="utf-8"></script>
</head>



<body>
    <div id="app">
        <div class="flex-center position-ref full-height ">
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

                </div>
            @endif



            <div class="search">
                <div class="title m-b-md search">

                    Deliveboo
                </div>
                Clicca su una categoria per trovare ristoranti nella tua zona.
                <search :typologies="{{ json_encode($typologies) }}"></search>
            </div>

        </div>
    </div>

</body>

</html>
