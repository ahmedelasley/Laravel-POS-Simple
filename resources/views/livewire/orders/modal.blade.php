<!-- Delete modal -->
<div wire:ignore.self class="modal fade" id="deleteModal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content tx-size-sm">
            <div class="modal-body tx-center pd-y-20 pd-x-20">
                <div class="modal-header">
                    <h6 class="modal-title">حذف البيانات</h6>
                    <button aria-label="Close" class="close" data-dismiss="modal" type="button" wire:click="close()"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form id="form" >
                        <h1>هل أنت متأكد من عملية الحذف ؟</h1>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn ripple btn-primary" type="button" wire:click.prevent="destroy()">نعم !</button>
                    <button class="btn ripple btn-secondary" data-dismiss="modal" type="button" wire:click="close()">إغلاق</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Delete modal -->

<!-- View modal -->
<div wire:ignore.self class="modal fade" id="updateModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">عرض الفاتورة</h6>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button" wire:click="close()"><span aria-hidden="true">&times;</span></button>
            </div>

            <div class="modal-body">
                @php
                    $setting = \App\Models\Setting::first();
                @endphp
                <div class="mx-1" id="print">
				<!-- row -->
				<div class="row row-sm" >

					<div class="col-md-12 col-md-offset-4">
						<div class="d-flex flex-row justify-content-center mg-b-20">
							<div>
								<div class=" main-content-body-invoice">
									<div class="card card-invoice " >
										<div class="card-body" id="print">
											<div class="d-flex flex-row justify-content-around">
												<div class="pd-10 text-center">
													@if ($setting->picture)
														<img src="{{ URL::asset($setting->picture) }}" alt="" class="w-50">
													@else
														<h1>{{ $setting->name }}</h1>
													@endif													
												</div>
											</div>
											<div class="d-flex flex-row justify-content-around">
												<div>
													<p class="my-0">{{ $setting->address }}</p>
													<p class="my-0">{{ $setting->phone }}</p>
												</div>
											</div>
											<div class="d-flex flex-row justify-content-around">
												<div class="text-center tx-20">
													<p class="my-0">****</p>
												</div>
											</div>
											<div class="d-flex flex-row justify-content-around">
												<div>
													<p class="my-0">{{ $customer_name }}</p>
												</div>
												<div>
													<p class="my-0">{{ $created_at }}</p>
												</div>
											</div>
											<div class="d-flex flex-row justify-content-around">
												<div>
													<p class="my-0">{{ $customer_address }}</p>
												</div>
												<div>
													<p class="my-0">{{ $customer_phone == 0 ?'' : $customer_phone }}</p>
												</div>
											</div>
											<div class="d-flex flex-row justify-content-around">
												<div class="text-center tx-20">
													<p class="my-0">****</p>
												</div>
											</div>
											<div class="d-flex flex-row justify-content-around">
												<div class="text-center tx-26 tx-bold">
													<p class="my-0">{{ $barcode  }}</p>
												</div>
											</div>
											<div class="table-responsive mg-t-40">
												<table class="table table-invoice border text-md-nowrap mb-0">
													<thead>
														<tr>
															<th class="wd-10p">#</th>
															<th class="wd-50p">المنتج</th>
															<th class="tx-center">الكمية</th>
															<th class="tx-center">التخفيض</th>
															<th class="tx-right">السعر</th>
															<th class="tx-right">المبلغ</th>
															<th class="tx-right"></th>
														</tr>
													</thead>
													<tbody>
														@if (\App\Models\OrderProduct::with('product')->where('order_id', $this->ids)->count() > 0)
															<?php
																$i=1; 
																$subTotal = 0 ;
															?>
															@foreach (\App\Models\OrderProduct::with('product')->where('order_id', $this->ids)->get() as $orderProduct)
															<?php
																$subTotal += $orderProduct->quantity * $orderProduct->price ; 
															?>
															<tr>
																<td><?php echo $i++; ?></td>
																<td class="tx-12">{{ $orderProduct->product->name }}</td>
																<td class="tx-center">{{ number_format($orderProduct->quantity, $setting->quantity) }}</td>
																<td class="tx-center">{{ $orderProduct->product->discount == 0 ? '': number_format($orderProduct->product->discount, $setting->price) . '%' }}</td>
																<td class="tx-right">{{ number_format($orderProduct->product->selling_price, $setting->price) }}</td>
																<td class="tx-right">{{ number_format($orderProduct->quantity * $orderProduct->price, $setting->price) }}</td>
                                                                <td>
																	@can('حذف منتج من الفاتورة')
                                                                    <a class="btn btn-danger btn-sm wd-30" wire:click.prevent="deleteProduct('{{ $orderProduct->id }}')" title="حذف المنتج من الفاتورة"><i class="fa fa-trash"></i></a>
																	@endcan
                                                                </td>
															</tr>
															@endforeach
														@endif
													</tbody>
												</table>
											</div>
											<div class="d-flex flex-row justify-content-around">
												<div class="text-center tx-20">
													<p class="my-0">****</p>
												</div>
											</div>
											<div class="d-flex flex-row justify-content-around">
												<div class="text-left tx-16">
													<p class="my-0">Total</p>
												</div>
												<div class="text-left tx-16">
													<p class="my-0">
                                                        
                                                        @if (isset($subTotal))
                                                            {{number_format($subTotal, $setting->price)}}
                                                        @endif
                                                        {{-- {{ number_format($subTotal, $setting->price)  }} --}}
                                                    
                                                    </p>
												</div>
											</div>
											<div class="d-flex flex-row justify-content-around">
												<div class="text-left tx-16">
													<p class="my-0">Payment</p>
												</div>
												<div class="text-left tx-16">
													<p class="my-0">{{ $amount == NULL ? : number_format($amount, $setting->price) }}</p>
												</div>
											</div>
											<div class="d-flex flex-row justify-content-around">
												<div class="text-left tx-16">
													<p class="my-0">Reset</p>
												</div>
												<div class="text-left tx-16">
													<p class="my-0">{{ $amount == NULL ? : number_format($subTotal - $amount, $setting->price) }}</p>
												</div>
											</div>
											<div class="d-flex flex-row justify-content-around">
												<div class="text-center tx-20">
													<p class="my-0">****</p>
												</div>
											</div>
											<div class="d-flex flex-row justify-content-around">
												<div class="text-center tx-30 tx-bold mt-1 text-capitalize">
													<p class="my-0">thank you</p>
													{!! QrCode::size(100)->generate(URL::asset('receipt-client/'. $barcode)); !!}
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
            </div>
            <div class="modal-footer">
                {{-- <button class="btn ripple btn-primary" type="button" onclick="printDiv()">طباعة</button> --}}
                <button class="btn ripple btn-secondary" data-dismiss="modal" type="button" wire:click="close()">إغلاق</button>
            </div>

        </div>
    </div>
</div>
<!-- End View modal -->

<!-- View modal -->
<div wire:ignore.self class="modal fade" id="viewModel" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">عرض الفاتورة</h6>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button" wire:click="close()"><span aria-hidden="true">&times;</span></button>
            </div>

            <div class="modal-body">
                @php
                    $setting = \App\Models\Setting::first();
                @endphp
                <div class="mx-1" id="print">
				<!-- row -->
				<div class="row row-sm" >

					<div class="col-md-12 col-md-offset-4">
						<div class="d-flex flex-row justify-content-center mg-b-20">
							<div>
								<div class=" main-content-body-invoice">
									<div class="card card-invoice " >
										<div class="card-body" id="printRec">
											<div class="d-flex flex-row justify-content-around">
												<div class="pd-10 text-center ">
													@if ($setting->picture)
														<img src="{{ URL::asset($setting->picture) }}" alt="" class="w-50">
													@else
														<h1>{{ $setting->name }}</h1>
														<h3>{{ $setting->type }}</h3>
													@endif
												</div>
											</div>
											<div class="d-flex flex-row justify-content-around">
												<div>
													<p class="my-0 tx-30 text-danger tx-bold">{{ $barcode  }}</p>
												</div>
											</div>
											<div class="d-flex flex-row justify-content-between mt-5 mb-1">
												<div>
													<p class="my-0 tx-20"><span class="tx-bold">الفرع :</span> {{ $setting->name }}</p>
												</div>
												<div>
													<p class="my-0 tx-20">{{ $created_at }}</p>
												</div>
											</div>
											<div class="d-flex flex-row justify-content-between mb-1">
												<div>
													<p class="my-0 tx-20"><span class="tx-bold">العميل :</span>{{ $customer_name }}</p>
												</div>
												<div>
													<p class="my-0 tx-20"><span class="tx-bold">الهاتف :</span>{{ $customer_phone == 0 ?'' : $customer_phone }}</p>
												</div>
											</div>
											<div class="d-flex flex-row justify-content-between mb-1">
												<div>
													<p class="my-0 tx-20"><span class="tx-bold">العنوان :</span> {{ $customer_address }}</p>
												</div>
											</div>


											<!-- <div class="d-flex flex-row justify-content-around">
												<div>
													<p class="my-0">{{ $setting->address }}</p>
													<p class="my-0">{{ $setting->phone }}</p>
												</div>
											</div> -->

											<div class="table-responsive mg-t-40 ">
												<table class="table border text-md-nowrap mb-0 ">
													<thead>
														<tr class="border-dark">
															<th class="wd-10p"><div class="tx-18 tx-bold tx-black">#</div></th>
															<th class="wd-40p"><div class="tx-18 tx-bold tx-black">الصنف</div></th>
															<th class="wd-10p"><div class="tx-18 tx-bold tx-black">السعر</div></th>
															<th class="wd-10p"><div class="tx-18 tx-bold tx-black">التخفيض</div></th>
															<th class="wd-10p"><div class="tx-18 tx-bold tx-black">الكمية</div></th>
															<th class="wd-20p"><div class="tx-18 tx-bold tx-black">الإجمالي</div></th>
														</tr>
													</thead>
													<tbody>
														@if (\App\Models\OrderProduct::with('product')->where('order_id', $this->ids)->count() > 0)
															<?php
																$i=1; 
																$subTotal = 0 ;
																$quantity = 0 ;
															?>
															@foreach (\App\Models\OrderProduct::with('product')->where('order_id', $this->ids)->get() as $orderProduct)
															<?php
																$subTotal += $orderProduct->quantity * $orderProduct->price ; 
																$quantity += $orderProduct->quantity; 
																?>
															<tr class="tx-center tx-black">
																<td><?php echo $i++; ?></td>
																<td>{{ $orderProduct->product->name }}</td>
																<td>{{ number_format($orderProduct->product->selling_price, $setting->price) }}</td>
																<td>{{ $orderProduct->product->discount == 0 ? '': number_format($orderProduct->product->discount, $setting->price) . '%' }}</td>
																<td>{{ number_format($orderProduct->quantity, $setting->quantity) }}</td>
																<td>{{ number_format($orderProduct->quantity * $orderProduct->price, $setting->price) }}</td>
															</tr>
															@endforeach
														@endif
													</tbody>
													<tfoot class="tx-bold tx-black">
														<tr>
															<td colspan="3" rowspan="3">
																<div class="text-center">
																	<span class="tx-40 tx-bold tx-black ">تسرنا زيارتكم !</span>
																</div>
															</td>
															<td><div class="tx-18">الإجمالي</div></td>
															<td>
																<!-- @if (isset($quantity)) -->
																	{{ number_format($quantity, $setting->quantity)}}
																<!-- @endif -->
															</td>
															<td>
																@if (isset($subTotal))
																	{{ number_format($subTotal, $setting->price)}}
																@endif
															</td>
														</tr>
														<tr>
															<td colspan="2"><div class="tx-18">المدفوع</div></td>
															<td>{{ $amount == NULL ? : number_format($amount, $setting->price) }}</td>
														</tr>
														<tr>
															<td colspan="2"><div class="tx-18">الباقي</div></td>
															<td>{{ $amount == NULL ? : number_format($subTotal - $amount, $setting->price) }}</td>
														</tr>
													</tfoot>
												</table>
											</div>


											<div class="d-flex flex-row justify-content-around">
												<div class="text-center tx-30 tx-bold mt-1 text-capitalize">
													{!! QrCode::size(150)->generate(URL::asset('receipt-client/'. $barcode)); !!}
												</div>
											</div>
											<div class="d-flex flex-row justify-content-around">
												<div class="text-center tx-30 tx-bold mt-1 text-capitalize">
													<hr>
												</div>
											</div>
											<div class="d-flex flex-row justify-content-around  tx-18 tx-bold text-center">
												<div>
													<p class="my-0">{{ $setting->address }}</p>
													<p class="my-0">{{ $setting->phone }}</p>
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
            </div>
            <div class="modal-footer">
                <button class="btn ripple btn-primary" type="button" onclick="printRe()">طباعة</button>
                <button class="btn ripple btn-secondary" data-dismiss="modal" type="button" wire:click="close()">إغلاق</button>
            </div>

        </div>
    </div>
</div>
<!-- End View modal -->