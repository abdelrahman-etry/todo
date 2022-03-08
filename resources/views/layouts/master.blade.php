<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta http-equiv="x-ua-compatible" content="ie=edge" />
        <title>@yield('title')</title>
    
        <!-- MDB icon -->
        <link rel="icon" href="{{ asset('assets/img/mdb-favicon.ico') }}" type="image/x-icon" />
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" />
        <!-- Google Fonts Roboto -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap"/>

        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
  
        <!-- Material Design Bootstrap -->
        <link rel="stylesheet" href="{{ asset('assets/css/mdb.min.css') }}">
  
        <!-- Your custom styles (optional) -->
        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

        @stack('extra-styles')
    </head>
  
    <body>
        <div class="container">
            @yield('content')
        </div>

        <!-- jQuery -->
        <script type="text/javascript" src="{{ asset('assets/js/jquery.min.js') }}"></script>
        <!-- Bootstrap tooltips -->
        <script type="text/javascript" src="{{ asset('assets/js/popper.min.js') }}"></script>
        <!-- Bootstrap core JavaScript -->
        <script type="text/javascript" src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
        <!-- MDB core JavaScript -->
        <script type="text/javascript" src="{{ asset('assets/js/mdb.min.js') }}"></script>

        @stack('extra-scripts')
    </body>
</html>
