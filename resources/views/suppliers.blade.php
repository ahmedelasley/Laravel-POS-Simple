@extends('layouts.master')
@section('css')
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">أهلا مرحبا بك </h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{Auth::user()->name}}</span>
        </div>
    </div>
    <div class="d-flex my-xl-auto right-content">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">الموردين</h4>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection

@section('content')
				<!-- row -->
				<div class="row  mg-t-20">
                    @can('الموردين')
					<livewire:suppliers.suppliers>
                    @else
                        <!-- Main-error-wrapper -->
						<div class="main-error-wrapper   ">
							<img src="{{URL::asset('assets/img/media/500.png')}}" class="error-page " alt="error">
							<h2>Oopps</h2>
							<h2>ليس لديك صلاحية للدخول علي هذه الصفحة</h2><a class="btn btn-outline-danger" href="{{ url('/') }}">العودة للصفحة الرئيسية</a>
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