@if (Auth::check())
    <?php $user = Auth::user();

    if(Request::url() && Request::is("admin/dashboard") && $user->hasRole('admin') )
    { ?>
      <script type="text/javascript">
        window.location = "{{ url('/admin/levels') }}";//here double curly bracket
      </script>
    <?php }
     ?>
    <!-- Left side column. contains the sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
          <div class="pull-left image">
            <img src="http://placehold.it/160x160/00a65a/ffffff/&text={{ Auth::user()->name[0] }}" class="img-circle" alt="User Image">
          </div>
          <div class="pull-left info">
            <p>{{ Auth::user()->name }}</p>
            {{-- <a href="#"><i class="fa fa-circle text-success"></i> Online</a> --}}
          </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
          <li class="header">{{ trans('backpack::base.administration') }}</li>
          <!-- ================================================ -->
          <!-- ==== Recommended place for admin menu items ==== -->
          <!-- ================================================ -->
          @if (!$user->hasRole('admin'))
          <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i> <span>{{ trans('backpack::base.dashboard') }}</span></a></li>
          @endif

          @if ($user->hasRole('admin') || $user->hasRole('teacher') || $user->hasRole('principle') )
          <li><a href="{{ url('admin/levels') }}"><i class="fa fa-bars"></i> <span>Filter</span></a></li>
          @endif

          @if ($user->hasRole('admin'))
            <li><a href="{{ url('admin/schools') }}"><i class="fa fa-building"></i> <span>Schools</span></a></li>
          @endif

          @if ($user->hasRole('admin') ||  $user->hasRole('principle') )
          <li><a href="{{ url('admin/classrooms') }}"><i class="fa fa-building"></i> <span>Classes</span></a></li>
          @endif
          
          @if ($user->hasRole('admin') || $user->hasRole('teacher') || $user->hasRole('principle') )
          <li><a href="{{ url('admin/students') }}"><i class="fa fa-child"></i> <span>Students</span></a></li>
          @endif
          
          @if ($user->hasRole('admin') ||  $user->hasRole('principle') )
          <li><a href="{{ url('admin/teachers') }}"><i class="fa fa-male"></i> <span>Teachers</span></a></li>
          @endif

          @if ($user->hasRole('admin') || $user->hasRole('teacher') || $user->hasRole('principle') || $user->hasRole('student'))
          <li><a href="{{ url('admin/guardians') }}"><i class="fa fa-user"></i> <span>Parents</span></a></li>
          @endif

          @if ($user->hasRole('admin'))
          <li><a href="{{ url('admin/grades') }}"><i class="fa fa-info-circle"></i> <span>Grades</span></a></li>
          @endif
          <!-- ======================================= -->
          <li class="header">{{ trans('backpack::base.user') }}</li>
          <li><a href="{{ url('admin/logout') }}"><i class="fa fa-sign-out"></i> <span>{{ trans('backpack::base.logout') }}</span></a></li>
        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>
@endif
