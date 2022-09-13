@extends('layouts.master')
@section('css')
<!--Internal  Datetimepicker-slider css -->
{{-- <link href="{{URL::asset('assets/plugins/amazeui-datetimepicker/css/amazeui.datetimepicker.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/pickerjs/picker.min.css')}}" rel="stylesheet"> --}}
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
            <h4 class="content-title mb-0 my-auto">الفواتير</h4>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection

@section('content')
				<!-- row -->
				<div class="row  mg-t-20">
                    @can('الفواتير')
                    <livewire:orders.orders>
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
{{-- <!--Internal  Datepicker js -->
<script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
<!--Internal  jquery.maskedinput js -->
<script src="{{URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js')}}"></script>
<!--Internal  spectrum-colorpicker js -->
<script src="{{URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js')}}"></script>
<!-- Internal Select2.min js -->
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<!--Internal Ion.rangeSlider.min js -->
<script src="{{URL::asset('assets/plugins/ion-rangeslider/js/ion.rangeSlider.min.js')}}"></script>
<!--Internal  jquery-simple-datetimepicker js -->
<script src="{{URL::asset('assets/plugins/amazeui-datetimepicker/js/amazeui.datetimepicker.min.js')}}"></script>
<!-- Ionicons js -->
<script src="{{URL::asset('assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.js')}}"></script>
<!--Internal  pickerjs js -->
<script src="{{URL::asset('assets/plugins/pickerjs/picker.min.js')}}"></script>
<!-- Internal form-elements js -->
<script src="{{URL::asset('assets/js/form-elements.js')}}"></script> --}}
@endsection