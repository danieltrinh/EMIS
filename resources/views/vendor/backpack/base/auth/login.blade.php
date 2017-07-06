@extends('backpack::layout')

@section('content')
    <div class="row">
    <div class="col-md-6 " id="login_intro" style=" text-align: left;">
            <img id="level_cover" style="width: 100%">
            <p id="long_des" style="padding-top: 1rem;"></p>

            <h4  id="title"> List of <span></span> School in the area</h4>
            <ul id="school_list">
            </ul>
            </div>
        <div class="col-md-6 ">
            <div class="box box-default">
                <div class="box-header with-border">
                    <div class="box-title">{{ trans('backpack::base.login') }}</div>
                </div>
                <div class="box-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('admin/login') }}">
                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">{{ trans('backpack::base.email_address') }}</label>

                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">{{ trans('backpack::base.password') }}</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> {{ trans('backpack::base.remember_me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ trans('backpack::base.login') }}
                                </button>

                                <a class="btn btn-link" href="{{ url('admin/password/reset') }}">{{ trans('backpack::base.forgot_your_password') }}</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
    $(document).ready(function(){
         if( $("#login_intro").length > 0)
    {
        if ($.cookie('level_login')==1)
        {
            $("#login_intro #level_cover").attr('src','{{ URL::to('/') }}/img/1.png')
            $("#login_intro #long_des").html('<strong>Primary education</strong> or <strong>elementary education</strong> is typically the first stage of compulsory education, coming between early childhood education and secondary education. Primary education usually takes place in a primary school or elementary school. In some countries, primary education is followed by middle school, an educational stage which exists in some countries, and takes place between primary school and high school.');
            $("#login_intro #title span").html("Primary");
            $("#login_intro #school_list").html('<li>Kim Dong Primary school: <a href ="http://www.aprimary.edu.vn/">http://www.kd.edu.vn/</a></li><li>Phan Van Tri Primary school: <a href ="http://www.aprimary.edu.vn/">http://www.pvt.edu.vn/</a></li><li>Nguyen Thuong Hien Primary school: <a href ="http://www.aprimary.edu.vn/">http://www.nth.edu.vn/</a></li>');
        }
        else if ($.cookie('level_login')==2)
        {
            $("#login_intro #level_cover").attr('src','{{ URL::to('/') }}/img/2.jpg')
           $("#login_intro #long_des").html('A <strong>secondary school</strong> is both an organization that delivers education and the building where this takes place. A secondary school can deliver level two <b>junior secondary education</b>, level 3 <b>(upper) secondary education</b> phases of the ISCED scale or both');
           $("#login_intro #title span").html("Secondary");
           $("#login_intro #school_list").html('<li>Nguyen Du Secondary school: <a href ="http://www.aprimary.edu.vn/">http://www.kd.edu.vn/</a></li><li>Nguyen Van Troi Secondary school: <a href ="http://www.aprimary.edu.vn/">http://www.pvt.edu.vn/</a></li><li>Quang Trung Secondary school: <a href ="http://www.aprimary.edu.vn/">http://www.nth.edu.vn/</a></li><li>Nguyen Dinh Chieu Secondary school: <a href ="http://www.aprimary.edu.vn/">http://www.nth.edu.vn/</a></li>');
       }
       else if ($.cookie('level_login')==3)
       {
        $("#login_intro #level_cover").attr('src','{{ URL::to('/') }}/img/3.jpg')
        $("#login_intro #long_des").html('<b>High school</b> is a kind of school, a place where people go to learn skills for future jobs. In a three-part system such as in the United States, children go to high school after middle school ("junior high"). In a two-part system such as in the United Kingdom, the change is from primary school to secondary school at 11 years of age.');
        $("#login_intro #title span").html("High");
        $("#login_intro #school_list").html('<li>Nguyen Cong Tru High school: <a href ="http://www.aprimary.edu.vn/">http://www.kd.edu.vn/</a></li><li>Le Quy Don High school: <a href ="http://www.aprimary.edu.vn/">http://www.pvt.edu.vn/</a></li><li>Trung Vuong High school: <a href ="http://www.aprimary.edu.vn/">http://www.nth.edu.vn/</a></li>');
    }
}
});
    </script>
@endsection
