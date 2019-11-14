<!DOCTYPE html>
<html lang="ja">
  @include('layouts.admin.head')
  <body>
    @include('layouts.admin.navigation')
    @include('layouts.admin.header')
    @yield('content')
    @include('layouts.admin.footer')
  </body>
</html>
