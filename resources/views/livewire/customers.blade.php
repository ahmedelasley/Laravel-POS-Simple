<div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
    
    @include('livewire.createCustomer')
    
    <div class="row row-sm">
        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2 mg-t-20 mg-lg-t-0">
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
                            <option value="phone">الهاتف</option>
                            <option value="address">العنوان</option>

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

        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 mg-t-20 mg-lg-t-0">
            <div class="card">
                <div class="card-body p-2">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search ..." wire:model="searchTerm">
                        <span class="input-group-append mx-1">
                            <a class="btn btn-primary text-white" data-target="#addCustomerModel" data-toggle="modal"><i class="fa fa-plus"></i></a>
                        </span>
                    </div>
                </div>
            </div>
        </div>

    </div>

    @include('livewire.changePictureCustomer')
    @include('livewire.updateCustomer')
    @include('livewire.deleteCustomer')


    <div class="card">
        {{-- <button class="btn btn-primary btn-icon" data-toggle="modal" data-target="#addCustomerModel"><i class="typcn typcn-plus"></i></button> --}}

        <div class="card-body">
            <div class="table-responsive text-center">
                <table class="table" id="">
                    <thead>
                        <tr>
                            <th class="wd-5p bg-gray-100 py-2 tx-20">#</th>
                            <th class="wd-10p py-2 tx-20">صورة</th>
                            <th class="wd-20p py-2 tx-20">الأسم</th>
                            <th class="wd-15p py-2 tx-20">البريد الألكتروني</th>
                            <th class="wd-10p py-2 tx-20">الهاتف</th>
                            <th class="wd-10p py-2 tx-20">الهاتف</th>
                            <th class="wd-10p py-2 tx-20">الحالة</th>
                            <th class="wd-20p py-2 tx-20">التحكم</th>
                        </tr>
                    </thead>
                    <tbody class="tx-18">
                        @php $i = 1; @endphp
                        @foreach ($customers as $customer)
                        <tr>
                            <td class="bg-gray-100">@php echo $i++ ; @endphp</td>
                            <td>
                                @if ($customer->picture)
                                    <img src="{{ URL::asset($customer->picture) }}" class="h-25 w-25">
                                @else
                                    <img src="{{ URL::asset('uploads/person.jpg') }}" class="h-25 w-25">
                                @endif
                            </td>
                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->email }}</td>
                            <td>{{ $customer->phone }}</td>
                            <td>{{ $customer->address }}</td>
                            <td>
                                @if ($customer->status == 0)
                                    <span class="label text-muted d-flex"><div class="dot-label bg-gray-300 ml-1"></div>
                                        Inactive
                                    </span>
                                @else
                                    <span class="label text-success d-flex"><div class="dot-label bg-success ml-1"></div>
                                        Active
                                    </span>
                                @endif

                            </td>
                            <td>
                                <div class="btn-icon-list mx-5">
                                    <button class="btn btn-primary btn-icon" data-toggle="modal" data-target="#changePictureCustomerModal" wire:click.prevent='editPictureCustomer({{ $customer->id }})' ><i class="typcn typcn-camera"></i></button>
                                    <button class="btn btn-success btn-icon" data-toggle="modal" data-target="#updateCustomerModal" wire:click.prevent='editCustomer({{ $customer->id }})'  ><i class="typcn typcn-edit"></i></button>
                                    <button class="btn btn-danger btn-icon" data-toggle="modal" data-target="#deleteCustomerModal" wire:click.prevent='deleteCustomer({{ $customer->id }})'><i class="typcn typcn-trash"></i></button>
                                </div>                                
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            <ul class="pagination product-pagination text-center">
                {{ $customers->links() }} 
            </ul>
        </div>
    </div>


</div>