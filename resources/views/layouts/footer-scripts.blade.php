<!-- Back-to-top -->
<a href="#top" id="back-to-top"><i class="las la-angle-double-up"></i></a>
<!-- JQuery min js -->
<script src="{{URL::asset('assets/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap Bundle js -->
<script src="{{URL::asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- Ionicons js -->
<script src="{{URL::asset('assets/plugins/ionicons/ionicons.js')}}"></script>
<!-- Moment js -->
<script src="{{URL::asset('assets/plugins/moment/moment.js')}}"></script>

<!-- Rating js-->
<script src="{{URL::asset('assets/plugins/rating/jquery.rating-stars.js')}}"></script>
<script src="{{URL::asset('assets/plugins/rating/jquery.barrating.js')}}"></script>

<!--Internal  Perfect-scrollbar js -->
<script src="{{URL::asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/perfect-scrollbar/p-scroll.js')}}"></script>
<!--Internal Sparkline js -->
<script src="{{URL::asset('assets/plugins/jquery-sparkline/jquery.sparkline.min.js')}}"></script>
<!-- Custom Scroll bar Js-->
<script src="{{URL::asset('assets/plugins/mscrollbar/jquery.mCustomScrollbar.concat.min.js')}}"></script>
<!-- right-sidebar js -->
<script src="{{URL::asset('assets/plugins/sidebar/sidebar-rtl.js')}}"></script>
<script src="{{URL::asset('assets/plugins/sidebar/sidebar-custom.js')}}"></script>
<!-- Eva-icons js -->
<script src="{{URL::asset('assets/js/eva-icons.min.js')}}"></script>


@yield('js')
<!-- Sticky js -->
<script src="{{URL::asset('assets/js/sticky.js')}}"></script>
<!-- custom js -->
<script src="{{URL::asset('assets/js/custom.js')}}"></script><!-- Left-menu js-->
<script src="{{URL::asset('assets/plugins/side-menu/sidemenu.js')}}"></script>
<script src="{{URL::asset('assets/js/sweetalert.min.js')}}"></script>
<script type="text/javascript">
	function printDiv() {
		var printContents = document.getElementById('print').innerHTML;
		var originalContents = document.body.innerHTML;
		document.body.innerHTML = printContents;
		window.print();
		document.body.innerHTML = originalContents;
		location.reload();
	}
	function printRe() {
		var printContents = document.getElementById('printRec').innerHTML;
		var originalContents = document.body.innerHTML;
		document.body.innerHTML = printContents;
		window.print();
		document.body.innerHTML = originalContents;
		location.reload();
	}
</script>
<script>
    window.addEventListener('close-modal', event => {
        
        $('#createModel').modal('hide');
        $('#updateModal').modal('hide');
        $('#deleteModal').modal('hide');
        $('#pictureModel').modal('hide');
        $('#statusModel').modal('hide');
        $('#barcodeModel').modal('hide');
        $('#viewModel').modal('hide');
        $('#passwordModel').modal('hide');

        
    })
    window.addEventListener('close-sub-modal', event => {
        
        $('#addCategoryModel').modal('hide');
        $('#addSupplierModel').modal('hide');
        
    })
</script>
<script>
	window.addEventListener('swal:min', event=>{
		swal({
			icon: event.detail.icon,
			title: event.detail.title,
			text: event.detail.text,
			timer: 3000,
		});
	});

	window.addEventListener('swal:max', event=>{
		swal({
			icon: event.detail.icon,
			title: event.detail.title,
			text: event.detail.text,
			timer: 3000,
		});
	});

	window.addEventListener('swal:alert', event=>{
		swal({
			// position: 'center',
			icon: event.detail.icon,
			title: event.detail.title,
			text: event.detail.text,
			// showConfirmButton: true,
			timer: 3000
		})

	});




</script>
