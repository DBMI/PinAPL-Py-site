<!doctype html>
<html class="no-js" lang="en">
  <head>
    <title> PinAPL.py - @yield('title', '') </title>
    <link rel="shortcut icon" href="/img/favicon.png">
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="/css/foundation.css" />
    <link rel="stylesheet" href="/css/app.css">
    @yield('customCSS')
    <script src="/js/vendor/modernizr.js"></script>
  </head>
  <body>
    @include('layouts.topbar')
    @if (!empty($title))
      <div class="row collapse">
        <div class="column">
          <h2>{{ $title }}</h2>
        </div>
      </div>
    @endif
    @if (!empty($description))
      <div class="row collapse" id="description-row">
        <div class="column">
          <p>{!! $description !!}</p>
        </div>
      </div>
    @endif
    <div class="row collapse">
      <div class="columns small-12">
        @yield('content')
      </div>
    </div>
    <script src="/js/vendor/jquery.js"></script>
    <script src="/js/vendor/what-input.js"></script>
    <script src="/js/vendor/foundation.min.js"></script>
    <script>
      $(document).foundation();
    </script>
    @yield('customScripts')
  </body>
</html>