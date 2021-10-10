<!DOCTYPE html>
<html lang="en">
  <head>
  <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Meta -->
    <meta name="description" content="Responsive Bootstrap 4 Dashboard Template">
    <meta name="author" content="BootstrapDash">
    <title>@yield('title')</title>
    @include('layout.style')
    @yield('style')
  </head>
  <body>
  @include('layout.header')
   <div class="az-content az-content-dashboard">
      <div class="container">
        <div class="az-content-body">
          @yield('content')
          @yield('modal')
        </div><!-- container -->
      </div><!-- az-header -->
    </div><!-- az-header -->
  @include('layout.footer')
  @include('layout.script')
  @yield('script')
  </body>
</html>
