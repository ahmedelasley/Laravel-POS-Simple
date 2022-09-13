<div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
    
    @include('livewire.products.modal')
    
    <div class="row row-sm">
        <div class="col-xs-2 col-sm-1 col-md-2 col-lg-2 col-xl-2 mg-t-20 mg-lg-t-0">
            <div class="card">
                <div class="card-body px-1 py-2">
                    <div class="input-group">
                        <select class="form-control" wire:model="paginateCount">
                            <option value=5>5</option>
                            <option value=10 selected>10</option>
                            <option value=20>20</option>
                            <option value=30>30</option>
                            <option value=40>40</option>
                            <option value=50>50</option>
                            <option value=100>100</option>
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

                            <option value="id">#</option>
                            <option value="name">الأسم</option>
                            <option value="quantity">الكمية</option>
                            <option value="selling_price">السعر</option>
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
        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2 mg-t-20 mg-lg-t-0">
            <div class="card">
                <div class="card-body p-2">
                    <div class="input-group">
                        <select class="form-control"  wire:model="selectCategory">
                            <option value="0">All Categories</option>
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
                        <input type="text" class="form-control" placeholder="Search ..." wire:model="searchTerm">
                        @can('أضافة منتج')
                        <span class="input-group-append mx-1">
                            <a class="btn btn-primary text-white" data-target="#createModel" data-toggle="modal"><i class="fa fa-plus"></i></a>
                        </span>
                        @endcan
                    </div>
                </div>
            </div>
        </div>

    </div>


    <div class="card">

        <div class="card-body">
            <div class="table-responsive text-center">
                <table class="table wd-100p">
                    <thead>
                        <tr>
                            <th class="w-5p bg-gray-100 py-2 tx-20">#</th>
                            <th class="wd-10p py-2 tx-20">باركود</th>
                            <th class="wd-10p py-2 tx-20">صورة</th>
                            <th class="wd-10p py-2 tx-20">الأسم</th>
                            <th class="wd-10p py-2 tx-20">الوصف</th>
                            <th class="wd-10p py-2 tx-20">الكمية</th>
                            <th class="wd-10p py-2 tx-20">سعر التكلفة</th>
                            <th class="wd-10p py-2 tx-20">سعر البيع</th>
                            <th class="wd-10p py-2 tx-20">نسبة التخفيض</th>
                            <th class="wd-10p py-2 tx-20">القسم</th>
                            <th class="wd-10p py-2 tx-20">المورد</th>
                            <th class="wd-10p py-2 tx-20">الحالة</th>
                            <th class="wd-10p py-2 tx-20">التحكم</th>
                        </tr>
                    </thead>
                    <tbody class="tx-18">
                        @php $i = 1; @endphp
                        @forelse ($products as $product)
                        <tr>
                            <td class="bg-gray-100">@php echo $i++ ; @endphp</td>
                            <td>{{ $product->barcode }}</td>
                            <td>
                                @if ($product->picture)
                                    <img src="{{ URL::asset($product->picture) }}" class="rounded h-50 w-50">
                                @else
                                    <img src="{{ URL::asset('mahrousa/public/uploads/product.jpg') }}" class="rounded h-50 w-50">
                                @endif
                            </td>
                            <td>{{ $product->name }}</td>
                            <td >{{ $product->name }}</td>
                            <td>{{ number_format($product->quantity, $setting->quantity) }}</td>
                            <td>{{ number_format($product->cost_price, $setting->price) }}</td>
                            <td>{{ number_format($product->selling_price, $setting->price) }}</td>
                            <td>{{ number_format($product->discount, $setting->price) }}</td>
                            <td>{{ $product->category_id ? $product->category->name : 'NULL' }}</td>
                            <td>{{ $product->supplier_id ? $product->supplier->name : 'NULL' }}</td>

                            <td>
                                @if ($product->status == 0)
                                    <span class="label text-danger d-flex"><div class="dot-label bg-danger ml-1"></div>
                                        غير نشط
                                    </span>
                                @else
                                    <span class="label text-success d-flex"><div class="dot-label bg-success ml-1"></div>
                                        نشط
                                    </span>
                                @endif

                            </td>
                            <td>
                                <div class="d-flex flex-row justify-content-center btn-icon-list mx-5">
                                    @can('صورة المنتج')
                                    <button class="btn btn-warning btn-icon" data-toggle="modal" data-target="#pictureModel" wire:click.prevent='editPicture({{ $product->id }})' ><i class="typcn typcn-camera"></i></button>
                                    @endcan
                                    @can('تعديل المنتج')
                                    <button class="btn btn-success btn-icon" data-toggle="modal" data-target="#updateModal" wire:click.prevent='edit({{ $product->id }})'  ><i class="typcn typcn-edit"></i></button>
                                    @endcan
                                    @can('حذف المنتج')
                                    <button class="btn btn-danger btn-icon" data-toggle="modal" data-target="#deleteModal" wire:click.prevent='delete({{ $product->id }})'><i class="typcn typcn-trash"></i></button>
                                    @endcan
                                    @can('حالة المنتج')
                                    <button class="btn btn-info btn-icon" data-toggle="modal" data-target="#statusModel" wire:click.prevent='status({{ $product->id }})'><i class="fa fa-check"></i></button>
                                    @endcan
                                    @can('باركود المنتج')
                                    <button class="btn btn-primary btn-icon" data-toggle="modal" data-target="#barcodeModel" wire:click.prevent='barcode({{ $product->id }})'><i class="fa fa-barcode"></i></button>
                                    @endcan
                                </div>                                
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="8"><h1>لا يوجد سجل</h1></td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            <div class="d-flex flex-row justify-content-around">
                <div class="">
                    <ul class="pagination product-pagination text-center">
                        {{ $products->links() }} 
                    </ul>
                </div>
            </div>
        </div>
    </div>


</div>