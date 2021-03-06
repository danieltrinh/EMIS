<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Encrypted CSRF token for Laravel, in order for Ajax requests to work --}}
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>
      {{ isset($title) ? $title.' :: '.config('backpack.base.project_name').' Admin' : config('backpack.base.project_name').' Admin' }}
    </title>

    @yield('before_styles')

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/') }}/bootstrap/css/bootstrap.min.css">
    
<script src="{{ asset('vendor/adminlte/') }}/dist/js/jquery.min.js"></script>
<script src="{{ URL::to('/') }}/js/jquery.cookie.js"></script>
<script src="{{ URL::to('/') }}/js/myscript.js"></script>

<script type="text/javascript" src="{{ asset('vendor/adminlte/') }}/dist/js/Chart.bundle.min.js"></script>


    <link rel="stylesheet" href="{{ asset('vendor/adminlte/') }}/dist/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/') }}/dist/css/ionicons.min.css">

    <link rel="stylesheet" href="{{ asset('vendor/adminlte/') }}/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/') }}/dist/css/skins/_all-skins.min.css">

    <link rel="stylesheet" href="{{ asset('vendor/adminlte/') }}/plugins/iCheck/flat/blue.css">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/') }}/plugins/morris/morris.css">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/') }}/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/') }}/plugins/datepicker/datepicker3.css">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/') }}/plugins/daterangepicker/daterangepicker-bs3.css">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/') }}/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/') }}/plugins/pace/pace.min.css">
    <link rel="stylesheet" href="{{ asset('vendor/backpack/pnotify/pnotify.custom.min.css') }}">

    <!-- BackPack Base CSS -->
    <link rel="stylesheet" href="{{ asset('vendor/backpack/backpack.base.css') }}">
    {{ HTML::style('css/style.css') }}
    @yield('after_styles')

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition  sidebar-mini <?php 
  $user = Auth::user();

  if($user)
  {
    if ($user->hasRole('admin')) 
      {
        echo "admin-ui skin-red-light ";
        $logo_text_big = "Administrator";
        $logo_text_mini = "A";
      }
    elseif ($user->hasRole('teacher'))
      {
        echo "teacher-ui skin-purple-light";
        $logo_text_big = "Teacher";
        $logo_text_mini = "T";
      }
    elseif ($user->hasRole('student'))
      {
        echo "student-ui skin-green-light";
        $logo_text_big = "Student";
        $logo_text_mini = "S";
      }
    elseif ($user->hasRole('parent'))
      {
        echo "parent-ui skin-blue";
        $logo_text_big = "Parent";
        $logo_text_mini = "P";
      }
    elseif ($user->hasRole('principle'))
      {
        echo "principle-ui skin-yellow";
        $logo_text_big = "Rector";
        $logo_text_mini = "R";
      }
  }
?>">
    <!-- Site wrapper -->
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="{{ url('') }}" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><?php
          if (isset($logo_text_mini))
            { echo $logo_text_mini; } 
          else {  ?>
            {!! config('backpack.base.logo_mini') !!}
          <?php }; ?></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg">
          <?php 
          if (isset($logo_text_big))
            { echo $logo_text_big; }
          else {  ?>
          {!! config('backpack.base.logo_lg') !!}
          <?php }; ?></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">{{ trans('backpack::base.toggle_navigation') }}</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>

          @include('backpack::inc.menu')
        </nav>
      </header>

      <!-- =============================================== -->

      @include('backpack::inc.sidebar')

      <!-- =============================================== -->

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
         @yield('header')

        <!-- Main content -->
        <section class="content">

          @yield('content')

        </section>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->

      <footer class="main-footer">
       
        {{ config('backpack.base.developer_name') }}</a>.
      </footer>
    </div>
    <!-- ./wrapper -->

    @yield('before_scripts')

    <!-- jQuery 2.2.0 -->
    <script src="{{ asset('vendor/adminlte/') }}/dist/js/jquery-2.2.0.min.js"></script>
    <script>window.jQuery || document.write('<script src="{{ asset('vendor/adminlte') }}/plugins/jQuery/jQuery-2.2.0.min.js"><\/script>')</script>
    <!-- Bootstrap 3.3.5 -->
    <script src="{{ asset('vendor/adminlte') }}/bootstrap/js/bootstrap.min.js"></script>
    <script src="{{ asset('vendor/adminlte') }}/plugins/pace/pace.min.js"></script>
    <script src="{{ asset('vendor/adminlte') }}/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <script src="{{ asset('vendor/adminlte') }}/plugins/fastclick/fastclick.js"></script>
    <script src="{{ asset('vendor/adminlte') }}/dist/js/app.min.js"></script>
<script src="{{ URL::to('/') }}/js/jquery.cookie.js"></script>

    <!-- page script -->
    <script type="text/javascript">
        // To make Pace works on Ajax calls
        $(document).ajaxStart(function() { Pace.restart(); });

        // Ajax calls should always have the CSRF token attached to them, otherwise they won't work
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

        // Set active state on menu element
        var current_url = "{{ url(Route::current()->getUri()) }}";
        $("ul.sidebar-menu li a").each(function() {
          if ($(this).attr('href').startsWith(current_url) || current_url.startsWith($(this).attr('href')))
          {
            $(this).parents('li').addClass('active');
          }
        });
    </script>

    @include('backpack::inc.alerts')

    @yield('after_scripts')

    <!-- JavaScripts -->
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>
