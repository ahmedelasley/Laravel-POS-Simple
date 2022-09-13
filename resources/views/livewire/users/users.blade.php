<div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
    
    @include('livewire.users.modal')
    
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
                        @can('أضافة مستخدم')
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
                            <th class="wd-10p py-2 tx-20">صورة</th>
                            <th class="wd-20p py-2 tx-20">الأسم</th>
                            <th class="wd-15p py-2 tx-20">البريد الألكتروني</th>
                            <th class="wd-10p py-2 tx-20">الهاتف</th>
                            <th class="wd-10p py-2 tx-20">الصلاحية</th>
                            <th class="wd-10p py-2 tx-20">الحالة</th>
                            <th class="wd-20p py-2 tx-20">التحكم</th>
                        </tr>
                    </thead>
                    <tbody class="tx-18">
                        @php $i = 1; @endphp
                        @forelse ($users as $user)
                        <tr>
                            <td class="bg-gray-100">@php echo $i++ ; @endphp</td>
                            <td>
                                @if ($user->picture)
                                    <img src="{{ URL::asset($user->picture) }}" class="img-thumbnail rounded h-25 w-25">
                                @else
                                    <img src="{{ URL::asset('mahrousa/public/uploads/person.jpg') }}" class="img-thumbnail rounded h-25 w-25">
                                @endif
                            </td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone }}</td>
                            {{-- <td>{{ $user->roles_name }}</td> --}}
                            <td>
                                @if (!empty($user->roles_name))
                                    @foreach ($user->roles_name as $key => $role)
                                        <label class="badge badge-primary">{{ $role }}</label>
                                    @endforeach
                                @endif
                            </td>
                            <td>
                                @if ($user->status == 0)
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
                                    @can('عرض المستخدم')
                                    <button class="btn btn-primary btn-icon" data-toggle="modal" data-target="#viewModel" wire:click.prevent='view({{ $user->id }})' ><i class="typcn typcn-eye"></i></button>
                                    @endcan

                                    @if ( !in_array('مالك البرنامج', $user->roles_name))

                                        @can('كلمة المرور')
                                        <button class="btn btn-danger btn-icon" data-toggle="modal" data-target="#passwordModel" wire:click.prevent='editPassword({{ $user->id }})' ><i class="typcn typcn-lock-closed"></i></button>
                                        @endcan
                                        @can('صورة المستخدم')
                                        <button class="btn btn-warning btn-icon" data-toggle="modal" data-target="#pictureModel" wire:click.prevent='editPicture({{ $user->id }})' ><i class="typcn typcn-camera"></i></button>
                                        @endcan
                                        @can('تعديل المستخدم')
                                        <button class="btn btn-success btn-icon" data-toggle="modal" data-target="#updateModal" wire:click.prevent='edit({{ $user->id }})'  ><i class="typcn typcn-edit"></i></button>
                                        @endcan
                                        @can('حذف المستخدم')
                                        <button class="btn btn-danger btn-icon" data-toggle="modal" data-target="#deleteModal" wire:click.prevent='delete({{ $user->id }})'><i class="typcn typcn-trash"></i></button>
                                        @endcan
                                        @can('حالة المستخدم')
                                        <button class="btn btn-info btn-icon" data-toggle="modal" data-target="#statusModel" wire:click.prevent='status({{ $user->id }})'><i class="fa fa-check"></i></button>
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
                        {{ $users->links() }} 
                    </ul>
                </div>
            </div>
        </div>
    </div>


</div>