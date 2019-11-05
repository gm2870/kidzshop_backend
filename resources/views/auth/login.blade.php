@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center pt-5">
		<div class="col-md-5">
			<div class="login-logo">
				<a href="#">پنل <strong>مدیریت</strong></a>
			</div>
    <!-- /.login-logo -->
		<div class="card">
			<div class="card-body login-card-body">
				<p class="login-box-msg">وارد حساب کاربری خود شوید</p>
		
				<form method="post">
					@csrf
				<div class="form-group has-feedback">
						<label for="username" class="w-100 col-form-label text-md-right">
							<input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus placeholder="ایمیل یا نام کاربری">
						</label>

					@error('email')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
					<i class="fas fa-envelope form-control-feedback"></i>
				</div>
				<div class="form-group has-feedback">
					<label for="password" class="w-100 col-form-label text-md-right">
						<input id="password" type="password" class="form-control" name="password" required autocomplete="current-password" placeholder="رمز عبور">
					</label>

					@error('password')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
					<i class="fas fa-lock form-control-feedback"></i>
				</div>
				<div class="row" style="direction:ltr">
					{{-- <div class="col-8">
						<div class="checkbox icheck">
							<label>
							<div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false" style="">
								<input type="checkbox">
								<span>مرا به خاطر بسپار</span>
							</div>
							</label>
						</div>
					</div> --}}
					<!-- /.col -->
			
					<div class="col-4">
					<button type="submit" id="login_btn" class="btn btn-primary btn-small btn-flat pt-1">ورود</button>
					</div>
					@if(Session::has('message'))
					<div class="col-8">
						<p class="text-right mb-0" style="color:orangered"><strong>{{ Session::get('message') }}</strong></p>
					</div>

					@endif
					<!-- /.col -->
				</div>
				</form>
	{{-- 	
				<div class="social-auth-links text-center mb-3">
				<p>- OR -</p>
				<a href="#" class="btn btn-block btn-primary">
					<i class="fa fa-facebook mr-2"></i> Sign in using Facebook
				</a>
				<a href="#" class="btn btn-block btn-danger">
					<i class="fa fa-google-plus mr-2"></i> Sign in using Google+
				</a>
				</div>
				<!-- /.social-auth-links --> --}}
		
				<p class="mb-1 text-right">
				<a href="#">رمز عبور خود را فراموش کردم</a>
				</p>
				<p class="mb-0 text-right">
				<a href="{{route('register')}}" class="text-center">ثبت نام</a>
				</p>
			</div>
			<!-- /.login-card-body -->
		</div>
  	</div>
</div>
@endsection
