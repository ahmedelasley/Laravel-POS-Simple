<!-- main-sidebar -->
		<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
		<aside class="app-sidebar sidebar-scroll">
			<div class="main-sidebar-header active">
				<a class="desktop-logo logo-light active" href="{{ route('home') }}"><img src="{{URL::asset('assets/img/brand/logo.svg')}}" class="main-logo" alt="logo"></a>
				<a class="desktop-logo logo-dark active" href="{{ route('home') }}"><img src="{{URL::asset('assets/img/brand/logo.svg')}}" class="main-logo dark-theme" alt="logo"></a>
				<a class="logo-icon mobile-logo icon-light active" href="{{ route('home') }}"><img src="{{URL::asset('assets/img/brand/favicon.svg')}}" class="logo-icon" alt="logo"></a>
				<a class="logo-icon mobile-logo icon-dark active" href="{{ route('home') }}"><img src="{{URL::asset('assets/img/brand/favicon.svg')}}" class="logo-icon dark-theme" alt="logo"></a>
			</div>
			<div class="main-sidemenu">
				<div class="app-sidebar__user clearfix">
					<div class="dropdown user-pro-body">
						<a href="{{ route('profile')}}">
							<div class="">
							@if (Auth::user()->picture)
								<img src="{{ URL::asset(Auth::user()->picture) }}" class="avatar avatar-xl brround"><span class="avatar-status profile-status bg-green"></span>
							@else
								<img src="{{ URL::asset('uploads/person.jpg') }}" class="avatar avatar-xl brround"><span class="avatar-status profile-status bg-green"></span>
							@endif
							</div>
							<div class="user-info">
								<h4 class="mt-3 mb-0 tx-bold tx-20">{{Auth::user()->name}}</h4>
								<span class="mb-0 text-muted">{{Auth::user()->email}}</span>
							</div>
						</a>
					</div>
				</div>
				<ul class="side-menu ">
					<li class="side-item side-item-category">الرئيسية</li>
					<li class="slide">
						<a class="side-menu__item" href="{{ route('home') }}"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24" ><path d="M0 0h24v24H0V0z" fill="none"/><path d="M5 5h4v6H5zm10 8h4v6h-4zM5 17h4v2H5zM15 5h4v2h-4z" opacity=".3"/><path d="M3 13h8V3H3v10zm2-8h4v6H5V5zm8 16h8V11h-8v10zm2-8h4v6h-4v-6zM13 3v6h8V3h-8zm6 4h-4V5h4v2zM3 21h8v-6H3v6zm2-4h4v2H5v-2z"/></svg><span class="side-menu__label tx-16">الصفحة الرئيسية</span></a>
					</li>
					<li class="side-item side-item-category">العام</li>
					@can('العملاء')
					<li class="slide my-2">
						<a class="side-menu__item" href="{{ route('customers') }}"><span class="side-menu__icon"><i class="fe fe-users"></i></span><span class="side-menu__label pd-t-8 tx-16 tx-facebook">العملاء</span></a>
					</li>
					@endcan

					@can('الأقسام')
						<li class="slide my-2">
							<a class="side-menu__item" href="{{ route('categories') }}"><span class="side-menu__icon"><i class="bx bx-server"></i></span><span class="side-menu__label pd-t-8 tx-16 tx-facebook">الأقسام</span></a>
						</li>
					@endcan

					@can('المنتجات')
					<li class="slide my-2">
						<a class="side-menu__item" href="{{ route('products') }}"><span class="side-menu__icon"><i class="bx bx-purchase-tag"></i></span><span class="side-menu__label pd-t-8 tx-16 tx-facebook">المنتجات</span></a>
					</li>
					@endcan

					@can('الموردين')
					<li class="slide my-2">
						<a class="side-menu__item tx-12" href="{{ route('suppliers') }}"><span class="side-menu__icon"><i class="bx bx-user"></i></span><span class="side-menu__label pd-t-8 tx-16 tx-facebook">الموردين</span></a>
					</li>
					@endcan

					@can('الفواتير')
					<li class="slide my-2">
						<a class="side-menu__item tx-12" href="{{ route('orders') }}"><span class="side-menu__icon"><i class="bx bx-file"></i></span><span class="side-menu__label pd-t-8 tx-16 tx-facebook">الفواتير</span></a>
					</li>
					@endcan

					@can('الأحصائيات')
					<li class="slide my-2">
						<a class="side-menu__item tx-12" href="{{ route('statistics') }}"><span class="side-menu__icon"><i class="bx bx-money"></i></span><span class="side-menu__label pd-t-8 tx-16 tx-facebook">الأحصائيات</span></a>
					</li>
					@endcan

					@can('المستخدمين')
					<li class="slide my-2">
						<a class="side-menu__item tx-12" href="{{ route('users') }}"><span class="side-menu__icon" ><i class="bx bx-user-circle"></i></span><span class="side-menu__label pd-t-8 tx-16 tx-facebook">المستخدمين</span></a>
					</li>
					@endcan

					@can('الصلاحيات')
					<li class="slide my-2">
						<a class="side-menu__item tx-12" href="{{ route('roles') }}"><span class="side-menu__icon" ><i class="bx bx-lock"></i></span><span class="side-menu__label pd-t-8 tx-16 tx-facebook">صلاحيات المستخدمين</span></a>
					</li>
					@endcan

					@can('الأعدادات')
					<li class="slide my-2">
						<a class="side-menu__item" href="{{ route('settings') }}"><span class="side-menu__icon" ><i class="bx bx-slider-alt"></i></span><span class="side-menu__label pd-t-8 tx-16 tx-facebook">الإعدادات</span></a>
					</li>
					@endcan

				</ul>
			</div>
		</aside>
<!-- main-sidebar -->
