<!doctype html>
<html class="no-js" lang="en">
  <head>
    <link rel="shortcut icon" href="/img/favicon.png">
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pinaple.py</title>
    <link rel="stylesheet" href="css/foundation.css" />
  </head>
  <body>
    @include('layouts.topbar')
    @yield('content')
    <script src="js/vendor/jquery.js"></script>
    <script src="js/vendor/what-input.js"></script>
    <script src="js/vendor/foundation.min.js"></script>
    <script>
      $(document).foundation();
    </script>

  </body>
</html>