<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/dashboard/">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css')}}">
    <!-- <script src="{{ asset('css/bootstrap-select.css')}}"> </script> -->

    <!-- <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script> -->

    <!-- <link href="{{ asset('select2/dist/css/select2.min.css')}}" rel="stylesheet" /> -->
    
    
    @yield('head')
  </head>
  <body>
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
      <a class="navbar-brand col-sm-12 col-md-3 mr-0 col-lg-3 col-xl-2 mr-0" href="#">{{ __('Manufacturer Panel') }}</a>
      
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a class="nav-link" href="{{route('user.logout')}}">Sign out</a>
        </li>
      </ul>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link active" href="{{ route('manufacturer.admin.dashboard')}}">
                  <span data-feather="home"></span>
                  Dashboard <span class="sr-only">(current)</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('manufacturer.admin.view.dealers')}}">
                  <span data-feather="users"></span>
                  Dealers
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('manufacturer.admin.view.vehicals')}}">
                  <span data-feather="shopping-cart"></span>
                  Vehicles
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('manufacturer.admin.create.transfered-vehicals')}}">
                  <span data-feather="send"></span>
                  Transfered Vehicles
                </a>
              </li>
            </ul>

            
          </div>
        </nav>
        @yield('content')
        
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    

    
    <script src="{{ asset('js/app.js')}}"> </script>

    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    
    <script>
      feather.replace()
    </script>
    <!-- <script src="{{ asset('select2/dist/js/select2.min.js')}}"></script> -->
    <!-- <script>
        
        $(document).ready(function() {
            $('.getDealers').select2();
            // $('.getVehicals').select2();
            $('.getVehicals-multiple').select2();
            
        });
    </script> -->


  </body>  
</html>
