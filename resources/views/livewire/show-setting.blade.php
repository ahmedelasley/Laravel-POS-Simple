<div class="col-12 col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
    @include('livewire.changeLogo')
    <div class="card mg-b-20">
        <div class="card-body">
            <div class="pl-0">
                <div class="main-profile-overview">
                    <div class="main-img-user profile-user" style="width: 100%; height:250px">
						@if ($setting->picture)
							<img alt="" src="{{ URL::asset($setting->picture) }}" class="rounded-0" >
						@else
							<img alt="" src="{{ URL::asset('uploads/logo.jpg') }}" class="rounded-0" >
						@endif
						@can('تعديل الأعدادات')
						<a class="fas fa-camera profile-edit" data-toggle="modal" data-target="#changeLogoModel"></a>
						@endcan
                    </div>
                    <div class="d-flex justify-content-between mg-b-20">
                        <div>
                            <h5 class="main-profile-name">{{ $setting->name }}</h5>
                            <p class="main-profile-name-text">{{ $setting->type }}</p>
                        </div>
                    </div>
                    <label class="main-content-label tx-13 mg-b-20">وصف</label>
                    <div class="main-profile-bio">
                        {{ $setting->description }}
                    </div><!-- main-profile-bio -->

                    <hr class="mg-y-30">
                    <label class="main-content-label tx-13 mg-b-20">معلومات الأتصال</label>
                    <div class="main-profile-social-list">
						<div class="media">
							<div class="media-icon bg-primary-transparent text-primary">
								<i class="icon ion-md-phone-portrait"></i>
							</div>
							<div class="media-body">
								<span>الهاتف</span>
								<div>
									{{ $setting->phone }}
								</div>
							</div>
						</div>
						<div class="media">
							<div class="media-icon bg-success-transparent text-success">
								<i class="fa fa-envelope"></i>
							</div>
							<div class="media-body">
								<span>البريد الإلكتروني</span>
								<div>
									{{ $setting->email }}
								</div>
							</div>
						</div>
						<div class="media">
							<div class="media-icon bg-info-transparent text-info">
								<i class="icon ion-md-locate"></i>
							</div>
							<div class="media-body">
								<span>العنوان</span>
								<div>
									{{ $setting->address }}
								</div>
							</div>
						</div>
                    </div>
                    <hr class="mg-y-30">
                    <label class="main-content-label tx-13 mg-b-20">معلومات البرنامج</label>
                    <div class="main-profile-social-list">
                        <div class="media">
							<div class="media-icon bg-primary-transparent text-primary">
								<i class="fa fa-money-bill"></i>
							</div>
							<div class="media-body">
								<span>العملة</span>
								<div>
									{{ $setting->currency }}
								</div>
							</div>
						</div>
						<div class="media">
							<div class="media-icon bg-success-transparent text-success">
								<i class="fa fa-money-bill"></i>
							</div>
							<div class="media-body">
								<span>التقريب العشري للأسعار</span>
								<div>
									{{ $setting->price }}
								</div>
							</div>
						</div>
						<div class="media">
							<div class="media-icon bg-info-transparent text-info">
								<i class="icon ion-md-locate"></i>
							</div>
							<div class="media-body">
								<span>التقريب العشري للكميات</span>
								<div>
									{{ $setting->quantity }}
								</div>
							</div>
						</div>
                    </div>
                    <hr class="mg-y-30">
                    <label class="main-content-label tx-13 mg-b-20">ملاحظات</label>
                    <div class="main-profile-social-list">
                        <div class="media">
							<div class="media-icon bg-primary-transparent text-primary">
								<i class="fa fa-info"></i>
							</div>
							<div class="media-body">
								<div>
									{{ $setting->notes }}
								</div>
							</div>
						</div>
                    </div>
                    
                </div><!-- main-profile-overview -->
            </div>
        </div>
    </div>
</div>
