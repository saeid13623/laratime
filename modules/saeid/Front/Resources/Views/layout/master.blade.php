<!doctype html>
<html lang="fa">
@include('Front::layout.head')
<body>
@include('Front::layout.header')
@include('sweet::alert')
  @yield('content')

@include('Front::layout.footer')
</body>
</html>
