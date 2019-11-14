<head>

@if (App::environment('production'))
  <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-63948629-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];

      function gtag() {
        dataLayer.push(arguments);
      }

      gtag('js', new Date());

      gtag('config', 'UA-63948629-1');
    </script>
  @endif

  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="format-detection" content="telephone=no">
  <meta charset="utf-8">
  <meta name="author" content="tyamahori">

  <title>@yield('page_title', 'tyamahori.com - tyamahoriが制作・運用するブログサイト')</title>
  <meta name="keywords" content="">
  <meta name="description" content="@yield('page_description', 'tyamahoriがいろいろな人の力を借りてスクラッチで作成したサイトです')">
  <meta name="author" content="tyamahori">
  <link rel="canonical" href="{{ url()->current() }}">

  <meta property="og:site_name" content="tyamahori.com">
  <meta property="og:title" content="@yield('page_title', 'tyamahori.com - tyamahoriが制作・運用するブログサイト')">
  <meta property="og:description" content="@yield('page_description', 'tyamahoriがいろいろな人の力を借りてスクラッチで作成したサイトです')">
  <meta property="og:type" content="website">
  <meta property="og:url" content="{{ url()->current() }}">
  <meta property="og:image" content="{{ asset('img/logo-sns.jpg') }}">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:creator" content="@tyamahori">
  <meta name="twitter:site" content="{{ url()->current() }}">
  <meta name="twitter:image" content="{{ asset('img/logo-sns.jpg') }}">

  {{-- コメントアウト部分
  <meta property="fb:app_id" content="App-ID（15文字の半角数字）" />
  --}}

<!-- Custom fonts for this template -->
  <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

  <link rel="stylesheet" href="{{ asset('css/bulma.css') . '?t=' . now()->timestamp }}">
  <link rel="stylesheet" href="{{ asset('css/style.css') . '?t=' . now()->timestamp }}">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  @yield('head')
</head>
