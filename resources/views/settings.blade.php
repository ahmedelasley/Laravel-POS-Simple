@extends('layouts.master')
@section('css')
@endsection
@section('page-header')
@endsection
@section('content')
				<!-- row -->
				<div class="row  mg-t-20">
					<livewire:show-setting>
					@can('تعديل الأعدادات')
					<livewire:edit-setting>
					@else
                        <!-- Main-error-wrapper -->
						<div class="main-error-wrapper   ">
							<img src="{{URL::asset('assets/img/media/500.png')}}" class="error-page " alt="error">
							<h2>Oopps</h2>
							<h2>ليس لديك صلاحية للدخول علي هذه الصفحة</h2>
							
						</div>
						<!-- /Main-error-wrapper -->
                    @endcan
				</div>
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
@endsection