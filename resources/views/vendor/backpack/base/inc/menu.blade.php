
<div class="navbar-custom-menu" style="margin-right: 70px;">
    <ul class="nav navbar-nav">
      <!-- ========================================================= -->
      <!-- ========== Top menu right items (ordered left) ========== -->
      <!-- ========================================================= -->

      <!-- <li><a href="{{ url('/') }}"><i class="fa fa-home"></i> <span>Home</span></a></li> -->

        @if (Auth::guest())
            <li><a href="{{ url('admin/login') }}">{{ trans('backpack::base.login') }}</a></li>
            @if (config('backpack.base.registration_open'))
            <li><a href="{{ url('admin/register') }}">{{ trans('backpack::base.register') }}</a></li>
            @endif
        @else
            <li><a href="{{ url('admin/logout') }}"><i class="fa fa-btn fa-sign-out"></i> {{ trans('backpack::base.logout') }}</a></li>
        @endif
            {{-- <li><a href="#">Instruction</a></li>
            <li><a href="#">Contact</a></li> --}}
       <!-- ========== End of top menu right items ========== -->
    </ul>
</div>
