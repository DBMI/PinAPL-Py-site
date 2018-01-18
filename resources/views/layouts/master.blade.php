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
    @if (!App::isLocal())
      <!-- Global site tag (gtag.js) - Google Analytics -->
      <script async src="https://www.googletagmanager.com/gtag/js?id=UA-64425044-2"></script>
      <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-64425044-2');
      </script>

    @endif
  </head>
  <body>
    @include('layouts.topbar')
    @if (!empty($errors) && count($errors)) 
    <div class="callout alert" id="error-messages">
      <p><i class="fi-alert"></i> There are some errors in your form.</p>
      <ul>
          @foreach($errors->all() as $error) 
            <li>{{ $error }}</li>
          @endforeach 
      </ul>
    </div>
    @endif 
    @yield('before_title')
    @if (!empty($title))
      <div class="row collapse align-center" id="title-row">
        <div class="column shrink">
          <h3>{{ $title }}</h3>
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
    <div class="row collapse" id="content-row">
      <div class="columns small-12" id="content">
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