<!DOCTYPE html>
<html lang="ja">
  @include('layouts.base.head')
  <body>
    @include('layouts.base.navigation')
    @include('layouts.base.header')
    @yield('content')
    @include('layouts.base.footer')
  </body>
</html>
