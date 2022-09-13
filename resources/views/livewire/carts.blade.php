
<div class="col-12 col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
    @include('livewire.createCustomer')
    <div class="row row-sm">
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 mg-t-20 mg-lg-t-0">
            <div class="card" >
                <div class="card-body p-2">
                    <div class="input-group">
                        {{-- <select class="form-control" wire:model="client">
                            @foreach ($customers as $customer)
                                <option  value="{{ $customer->id }}">
                                    {{ $customer->name .  $customer->phone }} 
                                </option>
                            @endforeach
                        </select> --}}
                        <input type="text" class="form-control" placeholder="هاتف العميل ...."  wire:model.lazy='phoneClient' >
                        @can('أضافة عميل سريع')
                        <span class="input-group-btn mx-1">
                            <a class="btn btn-primary" data-target="#addCustomerModel" data-toggle="modal" title="إضافة عميل جديد">
                                <span class="input-group-btn text-white"><i class="fa fa-plus"></i></span>
                            </a>
                        </span>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 mg-t-20 mg-lg-t-0">
            <div class="card">
                <div class="card-body p-2">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="باركود ....."  wire:model='barcodeProduct'  wire:keydown.enter="barcode()">
                        {{-- <input type="text" name="id"  value="{{ $product }}"> --}}
                        {{-- <h1>{{ $product }}</h1> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="card">
        <div class="card-header pb-0">
            <h5 class="card-title">
                <div class="d-flex flex-row justify-content-between">
                    <div class="">
                        سلة التسوق
                    </div>
                    <div class="text-center">
                        @php
                            $client = \App\Models\Customer::where('phone', 'LIKE', '%'.$phoneClient.'%' )->first();
                        @endphp
                        {{-- @if($client > 1) --}}
                            {!! $phoneClient == 0 ? $client->name : '<span>' . $client->name . ' ' . $client->phone !!}
                            {!! $phoneClient == 0 ? '' : '<br>' . $client->address .'</span>' !!}
                        {{-- @endif --}}
                    </div>

                </div>
            </h5>
        </div>
        <div class="card-body ht-500">
            @if ($carts->count() > 0)
            <div class="table-wrapper-scroll-y my-custom-scrollbar">
            <table class="table table-striped table-bordered table-sm text-center" cellspacing="0" width="100%" >
                <thead>
                    <tr>
                        <th>#</th>
                        <th>المنتج</th>
                        <th>الكمية</th>
                        <th>الأجمالي</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody >
                    <?php 
                        $i=1; 
                        $subTotal = 0 ;
                        $quantity = 0 ;
                        ?>
                    @foreach ($carts as $cart)
                    <?php 
                        $subTotal += $cart->quantity * (($cart->product->selling_price) - ( ($cart->product->selling_price * $cart->product->discount) / 100) ); 
                        $quantity += $cart->quantity;

                    ?>
                        <tr>
                            <td>
                                <?php echo $i++; ?>
                            </td>
                            <td>
                                @if($cart->product->picture)
                                    <img src="{{ URL::asset($cart->product->picture) }}" class="img-thumbnail rounded ht-50 w-30">
                                @endif
                                {{ $cart->product->name }}
                            </td>
                            <td>

                                <div class="my-1 wd-110 ">
                                    @can('نقص عدد منتج داخل السلة')
                                    <a class="btn btn-danger btn-sm wd-30 text-center" wire:click.prevent="decreaseQuantity('{{ $cart->id }}')" title="تقليل الكمية"><i class="fa fa-minus"></i></a>
                                    @endcan
                                    <input type="text" class="wd-40 text-center"  value="{{ number_format($cart->quantity, $setting->quantity) }}" readonly>
                                    @can('زيادة عدد منتج داخل السلة')
                                    <a class="btn btn-success btn-sm wd-30" wire:click.prevent="increaseQuantity('{{ $cart->id }}')" title="زيادة الكمية"><i class="fa fa-plus"></i></a>
                                    @endcan
                                </div>

                            </td>
                            <td>{{ number_format($cart->quantity * (($cart->product->selling_price) - ( ($cart->product->selling_price * $cart->product->discount) / 100) ), $setting->price) }}</td>
                            <td>
                                @can('حذف منتج من السلة')
                                <a class="btn btn-danger btn-sm wd-30" wire:click.prevent="deleteProduct('{{ $cart->id }}')" title="حذف المنتج من السلة"><i class="fa fa-trash"></i></a>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
            @else
                <h1>
                    <img src="{{ URL::asset('assets\img\cart.png') }}" class="img-thumbnail rounded ht-500 w-100 text-center">
                </h1>
            @endif

        </div>
        <div class="card-footer">
            @if ($carts->count() > 0)
                <div class="d-flex flex-row justify-content-between text-center">
                    <div class="">
                        عدد المنتجات<h4>{{ $carts->count() }}</h4>
                    </div>
                    <div class="">
                        عدد الكميات<h4>{{ number_format($quantity, $setting->quantity) }}</h4>
                    </div>
                    <div class="">
                        الأجمالي<h4 wire:model="subTotal">{{ number_format($subTotal, $setting->price) }}</h4>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row row-xs ">
                <div class="form-group col-sm-12 col-md-126 mg-t-10 mg-md-t-0">
                    <div class="d-flex flex-row justify-content-between text-center">
                        <div class="">
                            <label class="main-content-label tx-12 tx-medium">المبلغ المدفوع: {{ floatval($amount) }}</label>
                        </div>
                        <div class="">
                            <span>الباقي : <span class="tx-14 tx-bold">{{number_format($subTotal - ( floatval($amount) == NULL ? 0 : floatval($amount) ), $setting->price) }}</span></span>
                        </div>
                    </div>
                    <input class="form-control" type="number" name="amount" wire:model='amount' >
                    @error('amount')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                    
                </div>
                @can('تفريغ السلع')
                <div class="col-sm-6 col-md-6 mg-t-10 mg-md-t-0"><button class="btn btn-danger btn-with-icon btn-block" wire:click.prevent="cancelCart()" title="إلغاء وتفريغ السلة"><i class="typcn typcn-times"></i> إلغاء</button></div>
                @endcan
                {{-- <div class="col-sm-4 col-md-64 mg-t-10 mg-md-t-0"><button class="btn btn-warning btn-with-icon btn-block"><i class="typcn typcn-pending"></i> Pending</button></div> --}}
                @can('دفع السلة')
                <div class="col-sm-6 col-md-6 mg-t-10 mg-sm-t-0"><button class="btn btn-primary btn-with-icon btn-block" wire:click.prevent="pay()" title="تأكيد عملية الدفع"><i class="typcn typcn-tick"></i> دفع</button></div>
                @endcan
                {{-- <div class="col-sm-6 col-md-6 mg-t-10 mg-sm-t-0"><button class="btn btn-primary btn-with-icon btn-block" wire:model="subTotal" data-subTotal="{{ $subTotal }}" data-target="#payAmountModel" data-toggle="modal"><i class="typcn typcn-tick"></i> Pay</button></div> --}}
            </div>
            
        </div>
    </div>
</div>
@include('livewire.payAmount')

{{-- <script>
    $('#payAmountModel ').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var subTotal = button.data('subTotal')
        var modal = $(this)
        modal.find('.modal-body #subTotal').val(subTotal);
    })
</script> --}}