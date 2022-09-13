@extends('layouts.master2')
@section('css')
<!-- Sidemenu-respoansive-tabs css -->
<link href="{{URL::asset('assets/plugins/sidemenu-responsive-tabs/css/sidemenu-responsive-tabs.css')}}" rel="stylesheet">
@endsection
@section('content')
@php
	$setting = \App\Models\Setting::first();
@endphp
		<div class="container-fluid">
			<div class="row no-gutter">
				<!-- The image half -->
				<div class="col-md-6 col-lg-6 col-xl-7 d-none d-md-flex bg-primary-transparent">
					<div class="row wd-100p mx-auto text-center">
						<div class="col-md-12 col-lg-12 col-xl-12 my-auto mx-auto wd-100p">
							<img src="{{URL::asset('assets/img/media/login.png')}}" class="my-auto ht-xl-80p wd-md-100p wd-xl-80p mx-auto" alt="logo">
						</div>
					</div>
				</div>
				<!-- The content half -->
				<div class="col-md-6 col-lg-6 col-xl-5 bg-white">
					<div class="login d-flex align-items-center py-2">
						<!-- Demo content-->
						<div class="container p-0">
							<div class="row">
								<div class="col-md-10 col-lg-10 col-xl-9 mx-auto">
									<div class="card-sigin">
										@if ($setting->picture)
											<div class="m-auto d-flex"><img src="{{ URL::asset($setting->picture)}}" class="sign-favicon ht-500" alt="logo"></div>
										@else
											<div class="m-auto d-flex"><img src="{{ URL::asset('uploads/logo.jpg')}}" class="sign-favicon ht-500" alt="logo"></div>
										@endif
										<div class="card-sigin">
											<div class="main-signup-header">
												<form method="POST" action="{{ route('login') }}">
												@csrf
													<div class="form-group">
														<label>البريد الإلكتروني</label>
														<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="أكتب بريدك الإلكتروني" required autocomplete="email" autofocus>

														@error('email')
															<span class="invalid-feedback" role="alert">
																<strong>{{ $message }}</strong>
															</span>
														@enderror
													</div>
													<div class="form-group">
														<label>كلمة المرور</label>
														<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="أكتب كلمة المرور" required autocomplete="current-password">

														@error('password')
															<span class="invalid-feedback" role="alert">
																<strong>{{ $message }}</strong>
															</span>
														@enderror
													</div>
													<div class="form-group">
														<input class="" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

														<label class="" for="remember">
															تذكرني
														</label>
													</div>
													<button type="submit" class="btn btn-main-primary btn-block">تسجيل الدخول</button>
													{{-- <div class="row row-xs">
														<div class="col-sm-6">
															<button class="btn btn-block"><i class="fab fa-facebook-f"></i> Signup with Facebook</button>
														</div>
														<div class="col-sm-6 mg-t-10 mg-sm-t-0">
															<button class="btn btn-info btn-block"><i class="fab fa-twitter"></i> Signup with Twitter</button>
														</div>
													</div> --}}
												</form>
												{{-- <div class="main-signin-footer mt-5">
													@if (Route::has('password.request'))
													<p>
														<a href="{{ route('password.request') }}">
															{{ __('Forgot Your Password?') }}
														</a>
														</p>
													@endif
													<p>Don't have an account? <a href="{{ route('register') }}">Create an Account</a></p>
												</div> --}}
											</div>
										</div>
									</div>
								</div>
							</div>
						</div><!-- End -->
					</div>
				</div><!-- End -->
			</div>
		</div>
@endsection
@section('js')
@endsection