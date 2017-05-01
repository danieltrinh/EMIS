@extends('backpack::layout')

@section('content')
    <div class="row">
    <div class="col-md-6 " style=" text-align: left;">
            <img src="{{ URL::to('/') }}/img/1.png" style="width: 100%">

            <p style="padding-top: 1rem;"><strong>Primary education</strong> or <strong>elementary education</strong> is typically the first stage of compulsory education, coming between early childhood education and secondary education. Primary education usually takes place in a primary school or elementary school. In some countries, primary education is followed by middle school, an educational stage which exists in some countries, and takes place between primary school and high school.</p>

            <h4> List of Primary School in the area</h4>
            <ul>
                <li>Kim Dong Primary school: <a href ="http://www.aprimary.edu.vn/">http://www.kd.edu.vn/</a></li>
                <li>Phan Van Tri Primary school: <a href ="http://www.aprimary.edu.vn/">http://www.pvt.edu.vn/</a></li>
                <li>Nguyen Thuong Hien Primary school: <a href ="http://www.aprimary.edu.vn/">http://www.nth.edu.vn/</a></li>
                

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
@endsection
