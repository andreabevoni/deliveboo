<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <script src="{{asset('js/app.js')}}" charset="utf-8"></script>
    <title>Test</title>

    <style>

      body {
        text-align: center;
      }

      .click {
        margin: 0 20px;
        border: 1px solid red;
        padding: 10px;
        display: inline-block;
      }

      .selected {
        margin: 20px 0;
        font-size: 40px;
        color: blue;
      }

      .click:hover {
        cursor: pointer;
      }

    </style>


  </head>
  <body>

    <a href="{{route('test-cart')}}">Vai al carrello</a>

    <h1>SHOP</h1>

    <div id="app">

      <shop>
      </shop>

    </div>

  </body>
</html>
