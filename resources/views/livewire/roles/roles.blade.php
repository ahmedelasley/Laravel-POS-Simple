<div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
    
    @include('livewire.roles.modal')
    
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
                        @can('أضافة صلاحية')
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
                <table class="table" id="">
                    <thead>
                        <tr>
                            <th class="wd-5p bg-gray-100 py-2 tx-20">#</th>
                            <th class="wd-20p py-2 tx-20">الصلاحية</th>
                            <th class="wd-20p py-2 tx-20">عدد الأذونات</th>
                            <th class="wd-20p py-2 tx-20">التحكم</th>
                        </tr>
                    </thead>
                    <tbody class="tx-18">
                        @php $i = 1; @endphp
                        @forelse ($roles as $role)
                        <tr>
                            <td class="bg-gray-100">@php echo $i++ ; @endphp</td>

                            <td>{{ $role->name }}</td>
                            <td>{{ $role->permissions->count() }}</td>

                            <td>
                                
                                <div class="d-flex flex-row justify-content-center btn-icon-list mx-5">
                                    @can('عرض الصلاحية')
                                    <button class="btn btn-primary btn-icon" data-toggle="modal" data-target="#viewModel" wire:click.prevent='view({{ $role->id }})' ><i class="typcn typcn-eye"></i></button>
                                    @endcan
                                    @if ($role->name !== 'مالك البرنامج')
                                        @can('تعديل الصلاحية')
                                        <button class="btn btn-success btn-icon" data-toggle="modal" data-target="#updateModal" wire:click.prevent='edit({{ $role->id }})'  ><i class="typcn typcn-edit"></i></button>
                                        @endcan
                                        @can('حذف الصلاحية')
                                        <button class="btn btn-danger btn-icon" data-toggle="modal" data-target="#deleteModal" wire:click.prevent='delete({{ $role->id }})'><i class="typcn typcn-trash"></i></button>
                                        @endcan
                                    @endif

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
                        {{ $roles->links() }} 
                    </ul>
                </div>
            </div>
        </div>
    </div>


</div>