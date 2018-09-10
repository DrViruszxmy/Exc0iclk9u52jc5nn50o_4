@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-5 col-md-offset-4">
            <div class="panel panel-default panel-cus">
                <!-- <div class="panel-heading">Login</div> -->
                <div class="panel-body pp-size">
                    <div class="row">
                        <div class="col-md-4 pr-zero">
                            <img src="{{ asset('images/sis_logo/sis_logo.fw.png') }}" class="img-responsive sis-logo" alt="sis logo">
                        </div>
                        <div class="col-md-8 wrap-login">
                            <h1>Enrollment System</h1>
                        </div>
                    </div>
                    <hr class="hr-color">
                    <div class="row">
                        <div class="col-md-12">
                            <img src="{{ asset('images/sis_logo/login_logo.fw.png') }}" class="img-responsive pull-right" alt="sis logo">
                        </div>
                    </div>
                    <br>
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
                        
                        @if (session()->get('error'))
                            <span class="help-block" style="color: #a94442">
                                <strong>{!! session()->get('error') !!}</strong>
                            </span>
                        @endif
                        
                       
                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">

                            <div class="col-md-12">
                                <div class="input-group custom-input">
                                    <div class="input-group-addon user-icon">
                                        <span>
                                            <img src="{{ asset('images/sis_logo/user_logo.fw.png') }}" alt="user" class="">
                                        </span>
                                    </div>
                                    <input id="username" type="username" class="form-control" name="username" value="{{ old('username') }}" placeholder="username">
                                </div>

                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

                            <div class="col-md-12">
                                
                                <div class="input-group custom-input">
                                    <div class="input-group-addon user-icon">
                                        <span>
                                            <img src="{{ asset('images/sis_logo/lock_logo.fw.png') }}" alt="user" class="">
                                        </span>
                                    </div>
                                    <input id="password" type="password" class="form-control" name="password" placeholder="password">
                                </div>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn btn-primary login-button">
                                    <i class="fa fa-btn fa-sign-in"></i> Login
                                </button>

                                <!-- <a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Your Password?</a> -->
                            </div>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <small>Copyright &copy; 2018 Engtech Global Solution Inc.</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
