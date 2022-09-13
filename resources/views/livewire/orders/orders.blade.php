<div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
    
    @include('livewire.orders.modal')
    
    <div class="row row-sm">
        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-1 col-xl-1 mg-t-20 mg-lg-t-0">
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
        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-1 col-xl-1 mg-t-20 mg-lg-t-0">
            <div class="card">
                <div class="card-body p-2">
                    <div class="input-group">
                        <select class="form-control" wire:model="sortBy">

                            <option value="id">#</option>
                            <option value="barcode">رقم الفاتورة</option>
                            <option value="created_at">التاريخ</option>
                            <option value="amount">المبلغ</option>
                            <option value="customer_id">العميل</option>

                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-4 col-sm-4 col-md-3 col-lg-1 col-xl-1 mg-t-20 mg-lg-t-0">
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

        <div class="col-xs-5 col-sm-5 col-md-3 col-lg-2 col-xl-2 mg-t-20 mg-lg-t-0">
            <div class="card">
                <div class="card-body p-2">
                    <div class="input-group">
                        {{-- <div class="input-group col-md-4"> --}}
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="typcn typcn-calendar-outline tx-24 lh--9 op-6"></i>
                                </div>
                            </div><input class="form-control" id="" placeholder="YYYY-MM-DD" type="date" wire:model="searchDate">
                        {{-- </div> --}}
                    </div>
                </div>
            </div>
        </div>





        <div class="col-xs-7 col-sm-7 col-md-12 col-lg-7 col-xl-7 mg-t-20 mg-lg-t-0">
            <div class="card">
                <div class="card-body p-2">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="بحث ......" wire:model="searchTerm">
                    </div>
                </div>
            </div>
        </div>

    </div>


    <div class="card">

        <div class="card-body">
            <div class="table-responsive text-center">
                <table class="table" id="">
                    <thead>
                        <tr>
                            <th class="wd-5p bg-gray-100 py-2 tx-20">#</th>
                            <th class="wd-10p py-2 tx-20">تاريخ الفاتورة</th>
                            <th class="wd-20p py-2 tx-20">كود الفاتورة</th>
                            <th class="wd-15p py-2 tx-20">المبلغ المدفوع</th>
                            <th class="wd-10p py-2 tx-20">العميل</th>
                            <th class="wd-10p py-2 tx-20">المستخدم</th>
                            <th class="wd-20p py-2 tx-20">التحكم</th>
                        </tr>
                    </thead>
                    <tbody class="tx-16">
                        @php $i = 1; @endphp
                        @forelse ($orders as $order)
                        <tr>
                            <td class="bg-gray-100">@php echo $i++ ; @endphp</td>
                            <td>{{ $order->created_at }}</td>
                            <td>{{ $order->barcode }}</td>
                            <td>{{ number_format($order->amount, $setting->price) }}</td>
                            <td>{{ $order->customer->name  }}</td>
                            <td>{{ $order->user->name  }}</td>

                            <td>
                                <div class="d-flex flex-row justify-content-center btn-icon-list mx-5">
                                    @can('عرض الفاتورة')
                                    <button class="btn btn-primary btn-icon" data-toggle="modal" data-target="#viewModel" wire:click.prevent='view({{ $order->id }})' ><i class="typcn typcn-eye"></i></button>
                                    @endcan
                                    @can('تعديل الفاتورة')
                                    <button class="btn btn-success btn-icon" data-toggle="modal" data-target="#updateModal" wire:click.prevent='view({{ $order->id }})'  ><i class="typcn typcn-edit"></i></button>
                                    @endcan
                                    @can('حذف الفاتورة')
                                    <button class="btn btn-danger btn-icon" data-toggle="modal" data-target="#deleteModal" wire:click.prevent='delete({{ $order->id }})'><i class="typcn typcn-trash"></i></button>
                                    @endcan
                                    {{-- <button class="btn btn-info btn-icon" data-toggle="modal" data-target="#statusModel" wire:click.prevent='status({{ $order->id }})'><i class="fa fa-check"></i></button> --}}

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
                    <ul class="pagination product-pagination">
                        {{ $orders->links() }} 
                    </ul>
                </div>
            </div>
        </div>
    </div>


</div>