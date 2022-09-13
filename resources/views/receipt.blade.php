@extends('layouts.master')
@section('css')
@endsection
@section('page-header')
@endsection
@section('content')
				<!-- row -->
				<div class="row row-sm  mg-t-20" >

					<div class="col-md-12 col-md-offset-2">
						<div class="d-flex flex-row justify-content-center mg-b-20">
							<div class="pd-10 bg-gray-300">
								<div class=" main-content-body-invoice">
									<div class="card card-invoice " >
										<div class="card-body" id="print">
											<div class="d-flex flex-row justify-content-around">
												<div class="pd-10 text-center">
													<img src="{{ URL::asset($setting->picture) }}" alt="" class="w-50">
												</div>
											</div>
											<div class="d-flex flex-row justify-content-around">
												<div class="text-center tx-30">
													<p class="my-0">{{ $setting->address }}</p>
													<p class="my-0">{{ $setting->phone }}</p>
												</div>
											</div>
											<div class="d-flex flex-row justify-content-around">
												<div class="text-center tx-30">
													<p class="my-0">****</p>
												</div>
											</div>
											<div class="d-flex flex-row justify-content-around">
												<div class="text-center tx-30">
													<p class="my-0">{{ $order->customer->name }}</p>
												</div>
												<div class="text-center tx-30">
													<p class="my-0">{{ $order->created_at }}</p>
												</div>
											</div>
											<div class="d-flex flex-row justify-content-around">
												<div class="text-center tx-30">
													<p class="my-0">{{ $order->customer->address }}</p>
												</div>
												<div class="text-center tx-30">
													<p class="my-0">{{ $order->customer->phone == 0 ?'' : $order->customer->phone }}</p>
												</div>
											</div>
											<div class="d-flex flex-row justify-content-around">
												<div class="text-center tx-30">
													<p class="my-0">****</p>
												</div>
											</div>
											<div class="d-flex flex-row justify-content-around">
												<div class="text-center tx-26 tx-bold">
													<p class="my-0">{{ $order->barcode  }}</p>
												</div>
											</div>
											<div class="table-responsive mg-t-40">
												<table class="table table-invoice border text-md-nowrap mb-0 tx-30 ">
													<thead class="">
														<tr>
															<th class="wd-10p tx-bold tx-30">#</th>
															<th class="wd-50p h1">Product</th>
															<th class="tx-center tx-bold tx-30">QNTY</th>
															<th class="tx-center tx-bold tx-30">Discount</th>
															<th class="tx-right tx-bold tx-30">Price</th>
															<th class="tx-right tx-bold tx-30">Amount</th>
														</tr>
													</thead>
													<tbody>
														@if ($orderProducts->count() > 0)
															<?php
																$i=1; 
																$subTotal = 0 ;
															?>
															@foreach ($orderProducts as $orderProduct)
															<?php
																$subTotal += $orderProduct->quantity * $orderProduct->price ; 
															?>
															<tr>
																<td><?php echo $i++; ?></td>
																<td class="tx-25">{{ $orderProduct->product->name }}</td>
																<td class="tx-center">{{ number_format($orderProduct->quantity, $setting->quantity) }}</td>
																<td class="tx-center">{{ number_format($orderProduct->product->discount, $setting->price) }} %</td>
																<td class="tx-right">{{ number_format($orderProduct->product->selling_price, $setting->price) }}</td>
																<td class="tx-right">{{ number_format($orderProduct->quantity * $orderProduct->price, $setting->price) }}</td>
															</tr>
															@endforeach
														@endif
													</tbody>
												</table>
											</div>
											<div class="d-flex flex-row justify-content-around">
												<div class="text-center tx-30">
													<p class="my-0">****</p>
												</div>
											</div>
											<div class="d-flex flex-row justify-content-around">
												<div class="text-left tx-30">
													<p class="my-0">Total</p>
												</div>
												<div class="text-left tx-30">
													<p class="my-0">{{ number_format($subTotal, $setting->price) }}</p>
												</div>
											</div>
											<div class="d-flex flex-row justify-content-around">
												<div class="text-left tx-30">
													<p class="my-0">Payment</p>
												</div>
												<div class="text-left tx-30">
													<p class="my-0">{{ number_format($order->amount, $setting->price) }}</p>
												</div>
											</div>
											<div class="d-flex flex-row justify-content-around">
												<div class="text-left tx-30">
													<p class="my-0">Reset</p>
												</div>
												<div class="text-left tx-30">
													<p class="my-0">{{ number_format($subTotal - $order->amount, $setting->price) }}</p>
												</div>
											</div>
											<div class="d-flex flex-row justify-content-around">
												<div class="text-center tx-30">
													<p class="my-0">****</p>
												</div>
											</div>
											<div class="d-flex flex-row justify-content-around">
												<div class="text-center tx-30 tx-bold mt-1 text-capitalize">
													<p class="my-0">thank you</p>
													{!! QrCode::size(200)->generate(URL::asset('receipt-client/'. $order->barcode)); !!}
												</div>
											</div>
										</div>
										<div class="card-footer">
											<div class="d-flex flex-row justify-content-around">
												<div class="text-center tx-26 tx-bold mt-1 text-capitalize">
													<a class="btn btn-success btn-with-icon btn-block float-left mr-2" onclick="printDiv()">
														<i class="mdi mdi-printer ml-1"></i>Print
													</a>
												</div>
												<div class="text-center tx-26 tx-bold mt-1 text-capitalize">
													<a class="btn btn-purple btn-with-icon btn-block float-left mr-2" href="/">
														<i class="mdi mdi-cart ml-1"></i>POS
													</a>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

					</div><!-- COL-END -->
				</div>
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
@endsection