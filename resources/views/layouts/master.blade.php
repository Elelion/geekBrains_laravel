<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <link rel="stylesheet" href="{{ asset("css/fonts.css") }}">
    <link rel="stylesheet" href="{{ asset("css/style.css") }}">

    <!-- NOTE: bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- NOTE: end: bootstrap -->
</head>

<body>
  <div class="container">
    <div class="title col-md-6">
      Laravel
    </div>

    <div class="links top-right p-t-pt-30 col-md-6">
      <a href="{{ route('index') }}">Главная</a>
      <a href="{{ route('info') }}">О проекте</a>
      <a href="{{ route('news') }}">Новости</a>
    </div>

  </div>

  <div class="flex-center position-ref full-height">
      <div class="content">
          @yield('content')
      </div>
  </div>

  <footer class="footer">
    <div class="container">
      <div class="links col-md-6">
        <a href="{{ route('index') }}">Главная</a>
      </div>
    </div>
  </footer>
</body>
</html>
