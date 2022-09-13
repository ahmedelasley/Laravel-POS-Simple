<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="Description" content="Bootstrap Responsive Admin Web Dashboard HTML5 Template">
		<meta name="Author" content="Spruko Technologies Private Limited">
		<meta name="Keywords" content="admin,admin dashboard,admin dashboard template,admin panel template,admin template,admin theme,bootstrap 4 admin template,bootstrap 4 dashboard,bootstrap admin,bootstrap admin dashboard,bootstrap admin panel,bootstrap admin template,bootstrap admin theme,bootstrap dashboard,bootstrap form template,bootstrap panel,bootstrap ui kit,dashboard bootstrap 4,dashboard design,dashboard html,dashboard template,dashboard ui kit,envato templates,flat ui,html,html and css templates,html dashboard template,html5,jquery html,premium,premium quality,sidebar bootstrap 4,template admin bootstrap 4"/>
		@include('layouts.head')
		@livewireStyles
	</head>

	<body class="main-body app sidebar-mini">
		<!-- Loader -->
		<div id="global-loader">
			<img src="{{URL::asset('assets/img/loader.svg')}}" class="loader-img" alt="Loader">
		</div>
		<!-- /Loader -->
		@include('layouts.main-sidebar')		
		<!-- main-content -->
		<div class="main-content app-content">
			@include('layouts.main-header')			
			<!-- container -->
			<div class="container-fluid">
				@yield('page-header')
				@yield('content')
				
				@include('layouts.sidebar')
				@include('layouts.models')
            	@include('layouts.footer')
				@include('layouts.footer-scripts')	

				@livewireScripts
				{{-- @include('sweetalert::alert') --}}

				<script>
					window.livewire.on('addCustomer', ()=>{
						$('#addCustomerModel').modal('hide');
					});
					window.livewire.on('addCustomer', ()=>{
						$('#form')[0].reset();
					});


					window.livewire.on('addProduct', ()=>{
						$('#addProductModel').modal('hide');
					});
					window.livewire.on('addProduct', ()=>{
						$('#form')[0].reset();
					});


					window.livewire.on('addCategory', ()=>{
						$('#addCategoryModel').modal('hide');
					});
					window.livewire.on('addCategory', ()=>{
						$('#form')[0].reset();
					});


					window.livewire.on('addSupplier', ()=>{
						$('#addSupplierModel').modal('hide');
					});
					window.livewire.on('addSupplier', ()=>{
						$('#form')[0].reset();
					});



					window.livewire.on('changeLogo', ()=>{
						$('#changeLogoModel').modal('hide');
					});
					window.livewire.on('changeLogo', ()=>{
						$('#form')[0].reset();
					});




					window.livewire.on('changePictureCustomer', ()=>{
						$('#changePictureCustomerModal').modal('hide');
					});
					window.livewire.on('changePictureCustomer', ()=>{
						$('#form')[0].reset();
					});

					window.livewire.on('updateCustomer', ()=>{
						$('#updateCustomerModal').modal('hide');
					});
					window.livewire.on('updateCustomer', ()=>{
						$('#form')[0].reset();
					});


					window.livewire.on('deleteCustomer', ()=>{
						$('#deleteCustomerModal').modal('hide');
					});
					window.livewire.on('deleteCustomer', ()=>{
						$('#form')[0].reset();
					});






					window.livewire.on('addSupplier', ()=>{
						$('#addSupplierModel').modal('hide');
					});
					window.livewire.on('addSupplier', ()=>{
						$('#form')[0].reset();
					});

					window.livewire.on('update', ()=>{
						$('#updateModal').modal('hide');
					});
					window.livewire.on('update', ()=>{
						$('#form')[0].reset();
					});



					window.livewire.on('changePicture', ()=>{
						$('#changePictureModal').modal('hide');
					});
					window.livewire.on('changePicture', ()=>{
						$('#form')[0].reset();
					});

					window.livewire.on('pay', ()=>{
						$('#payAmountModel').modal('hide');
					});
					window.livewire.on('pay', ()=>{
						$('#form')[0].reset();
					});
				</script>
	</body>
</html>