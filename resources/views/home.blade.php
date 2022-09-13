@extends('layouts.master')
@section('css')
	<style>
		.my-custom-scrollbar {
			position: relative;
			height: 500px;
			overflow: auto;
		}
		.table-wrapper-scroll-y {
			display: block;
		}
		.card .backgroundEffect:hover {
			/* color: #fff; */
			transform: scale(1.025);
			box-shadow: rgba(0, 0, 0, 0.24) 0px 5px 10px
		}
	</style>
@endsection
@section('page-header')
@endsection
@section('content')
				<!-- row -->
				<div class="row  mg-t-20">
					<livewire:carts /> 
					<livewire:products /> 
				</div>
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
@endsection