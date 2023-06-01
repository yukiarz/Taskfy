<!DOCTYPE html>
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Dashboard | @yield('title')</title>

    @yield('meta')
    <link rel="icon" type="image/x-icon" href="{{asset('launch/img/favicon/favicon.ico')}}" />

    <!-- Fonts -->
    <meta name="csrf-token" content="{{ csrf_token() }}"> 
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('launch/vendor/fonts/boxicons.css')}}" />
    <link rel="stylesheet" href="{{asset('launch/vendor/css/core.css')}}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{asset('launch/vendor/css/theme-default.css')}}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{asset('launch/css/demo.css')}}" />
    <link rel="stylesheet" href="{{asset('launch/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="{{asset('launch/vendor/libs/apex-charts/apex-charts.css')}}" />
    <script src="{{asset('launch/vendor/js/helpers.js')}}"></script>
    <script src="{{asset('launch/js/config.js')}}"></script>
    @yield('css')

  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="{{ (Request::is(['login','register'])) ? '' : 'layout-wrapper' }} layout-content-navbar">
      <div class="{{ (Request::is(['login','register'])) ? '' : 'layout-container' }}">
        @if(!Request::is(['login','register']))
          @include('base.sidebar')
        @endif

        <div class="{{ (Request::is(['login','register'])) ? '' : 'layout-page' }}">
          @if(!Request::is(['login','register']))
            @include('base.header')
          @endif

          <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
                @yield('content')
            </div>
            @if(!Request::is(['login','register']))
            @include('base.footer')
            @endif
            <div class="content-backdrop fade"></div>
          </div>
        </div>
      </div>
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <script src="{{asset('launch/vendor/libs/jquery/jquery.js')}}"></script>
    <script src="{{asset('launch/vendor/libs/popper/popper.js')}}"></script>
    <script src="{{asset('launch/vendor/js/bootstrap.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="{{asset('launch/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
    <script src="{{asset('launch/vendor/js/menu.js')}}"></script>
    <script src="{{asset('launch/vendor/libs/apex-charts/apexcharts.js')}}"></script>
    <script src="{{asset('launch/js/main.js')}}"></script>
    <script src="{{asset('launch/js/dashboards-analytics.js')}}"></script>
    @stack('script')
    <script>
    @if(Session::has('success'))
  toastr.options =
  {
  	"closeButton" : true,
  }
  		toastr.success("{{ session('success') }}");
  @endif

  @if(Session::has('error'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true
  }
  		toastr.error("{{ session('error') }}");
  @endif

  @if(Session::has('info'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true
  }
  		toastr.info("{{ session('info') }}");
  @endif

  @if(Session::has('warning'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true
  }
  		toastr.warning("{{ session('warning') }}");
  @endif

    
</script>
  </body>
</html>
