
<div class="col-12 col-xs-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
    <div class="row row-sm">
        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1 mg-t-20 mg-lg-t-0">
            <div class="card">
                <div class="card-body px-1 py-2">
                    <div class="input-group">
                        <select class="form-control" wire:model="paginateCount">
                            <option value=6>6</option>
                            <option value=12>12</option>
                            <option value=18 selected>18</option>
                            <option value=24>24</option>
                            <option value=30>30</option>
                            <option value=36>36</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2 mg-t-20 mg-lg-t-0">
            <div class="card">
                <div class="card-body p-2">
                    <div class="input-group">
                        <select class="form-control" wire:model="sortBy">
                            <option value="id">ID</option>
                            <option value="name">أسم المنتج</option>
                            <option value="quantity">الكمية</option>
                            <option value="selling_price">السعر</option>
                            <option value="category_id">القسم</option>

                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2 mg-t-20 mg-lg-t-0">
            <div class="card">
                <div class="card-body p-2">
                    <div class="input-group">
                        <select class="form-control" wire:model="orderBy">
                            <option value="ASC">تصاعدي</option>
                            <option value="DESC">تنازلي</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 mg-t-20 mg-lg-t-0">
            <div class="card">
                <div class="card-body p-2">
                    <div class="input-group">
                        <select class="form-control"  wire:model="selectCategory">
                            <option value="0">كل الأقسام</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 mg-t-20 mg-lg-t-0">
            <div class="card">
                <div class="card-body p-2">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="بحث ......" wire:model="searchTerm">
                        @can('أضافة منتج سريع')
                            <span class="input-group-append mx-1">
                                <a class="btn btn-primary text-white" data-target="#addProductModel" data-toggle="modal" title="إضافة منتج جديد"><i class="fa fa-plus"></i></a>
                            </span>
                        @endcan
                        
                    </div>
                </div>
            </div>
        </div>

    </div>


    @include('livewire.createProduct')
    @include('livewire.createCategory')
    @include('livewire.createSupplier')
    {{-- {{ $selectCategory}} --}}

    <div class="row row-sm">

        @forelse ($products as $product)
        <div class="col-6 col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
            <a class="" wire:click.prevent="cart('{{ $product->id }}')">
            <div class="card " >
                @if ($product->discount != 0)
                    <span class="sale-tag bg-danger text-white top-0 pos-absolute z-index-10 rounded-5 m-1 px-2">{{ number_format($product->discount, $setting->price) }} %</span>
                @endif
                <div class="card-body backgroundEffect mt-2">

                    @if ($product->picture)
                    <div class="pro-img-box">
                        
                        <img class="w-100 ht-100" src="{{URL::asset($product->picture)}}" alt="product-image">
                    </div>
                    @endif

                    <div class="text-center">
                        <h3 class="h5 mb-2 mt-4 font-weight-bold text-uppercase">{{ $product->name }}</h3>
                        <h3 class="h6 mb-1 mt-1 font-weight-bold text-start"> {{ number_format($product->quantity, $setting->quantity) }}</h3>
                        {{-- <h5 class="h6 mb-2 mt-4 font-weight-bold text-uppercase"><i class="las la-shopping-cart "> : {{ $product->quantity }}</h5> --}}
                        @if ($product->discount == 0)
                            <h4 class="h5 mb-0 mt-2 text-center font-weight-bold text-danger">{{ number_format($product->selling_price, $setting->price) }}</h4>
                        @elseif ($product->discount != 0)
                            <h6 class="h5 mb-0 mt-2 text-center font-weight-bold text-danger">{{ number_format(($product->selling_price) - ( ($product->selling_price * $product->discount) / 100), $setting->price) }} <span class="text-secondary font-weight-normal tx-13 ml-1 prev-price">{{ number_format($product->selling_price, $setting->price) }}</span></h6>

                        @endif
                    </div>
                </div>
            </div>
            </a>
        </div>
        @empty
        <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <!-- Main-error-wrapper -->
            <div class="main-error-wrapper   ">
                <h1>لا يوجد منتجات</h1>
            </div>
            <!-- /Main-error-wrapper -->
        </div>
        @endforelse

    </div>
    <ul class="pagination product-pagination text-center">
        {{ $products->links() }} 
    </ul>
</div>

