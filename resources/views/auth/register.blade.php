@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center pt-5">
        <div class="col-md-5">
            <div class="login-logo">
                <a href="#">پنل <strong>مدیریت</strong></a>
            </div>
            <div class="card">
                <div class="card-body register-card-body">
                    <p class="login-box-msg">عضویت جدید</p>
            
                    <form method="post">
                        @csrf
                        <div class="form-group has-feedback">
                            <label for="username" class="w-100 col-form-label text-md-right">
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus placeholder="نام کاربری یا ایمیل">
                            </label>
                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <i class="fa fa-user form-control-feedback"></i>
                        </div>
                        <div class="form-group has-feedback">
                            <label for="email" class="col-form-label text-md-right w-100">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="ایمیل">
                            </label>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <i class="fa fa-envelope form-control-feedback"></i>
                        </div>
                        <div class="form-group has-feedback">
                            <label for="password" class="w-100 col-form-label text-md-right">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="رمز عبور">
                            </label>

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <i class="fa fa-lock form-control-feedback"></i>
                        </div>
                        <div class="form-group has-feedback">
                                <label for="password-confirm" class="w-100 col-form-label text-md-right">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="تکرار رمز عبور">
                                </label>
                            <i class="fa fa-lock form-control-feedback"></i>
                        </div>
                        @if ($errors->has('password'))
                        <div class="error red" style="direction:ltr">{{ $errors->first('password') }}</div>
                        @endif
                        <div class="row direction-rtl" style="direction: rtl">
                            <div class="col-8 d-flex align-items-center">
                                <a href="{{route('login')}}" class="d-block text-right">قبلا ثبت نام کرده ام</a>
                            </div>
                            {{-- <div class="col-8">
                                <div class="checkbox icheck">
                                    <label>
                                    <div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false" style="position: relative;"><input type="checkbox" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> I agree to the <a href="#">terms</a>
                                    </label>
                                </div>
                            </div> --}}
                            <!-- /.col -->
                            <div class="col-4">
                            <button type="submit" id="register_btn" class="btn btn-primary btn-block btn-flat ">ثبت نام</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>
            
                    {{-- <div class="social-auth-links text-center">
                    <p>- OR -</p>
                    <a href="#" class="btn btn-block btn-primary">
                        <i class="fa fa-facebook mr-2"></i>
                        Sign up using Facebook
                    </a>
                    <a href="#" class="btn btn-block btn-danger">
                        <i class="fa fa-google-plus mr-2"></i>
                        Sign up using Google+
                    </a>
                    </div>
             --}}
                </div>
            <!-- /.form-box -->
            </div>
        </div>
    </div>
</div>
@endsection
