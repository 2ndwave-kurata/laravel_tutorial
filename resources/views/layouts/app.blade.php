<html>
  <head>
    <title>Blog - @yield('title')</title>
    @yield('script')
  </head>
  <body>
    <div class="container">
      @yield('content')
    </div>
    <footer class="footer">
  @yield('footer')
</footer>
  </body>
</html>