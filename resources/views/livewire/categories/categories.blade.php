<div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
    
    @include('livewire.categories.modal')
    
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
                        @can('أضافة قسم')
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
                            <th class="wd-15p py-2 tx-20">الوصف</th>
                            <th class="wd-10p py-2 tx-20">الحالة</th>
                            <th class="wd-20p py-2 tx-20">التحكم</th>
                        </tr>
                    </thead>
                    <tbody class="tx-18">
                        @php $i = 1; @endphp
                        @forelse ($categories as $category)
                        <tr>
                            <td class="bg-gray-100">@php echo $i++ ; @endphp</td>
                            <td>
                                @if ($category->picture)
                                    <img src="{{ URL::asset($category->picture) }}" class="img-thumbnail rounded h-25 w-25">
                                @else
                                    <img src="{{ URL::asset('mahrousa/public/uploads/category.jpg') }}" class="img-thumbnail rounded h-25 w-25">
                                @endif
                            </td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->description }}</td>

                            <td>
                                @if ($category->status == 0)
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
                                    @can('صورة القسم')
                                    <button class="btn btn-warning btn-icon" data-toggle="modal" data-target="#pictureModel" wire:click.prevent='editPicture({{ $category->id }})' ><i class="typcn typcn-camera"></i></button>
                                    @endcan
                                    @can('تعديل القسم')
                                    <button class="btn btn-success btn-icon" data-toggle="modal" data-target="#updateModal" wire:click.prevent='edit({{ $category->id }})'  ><i class="typcn typcn-edit"></i></button>
                                    @endcan
                                    @can('حذف القسم')
                                    <button class="btn btn-danger btn-icon" data-toggle="modal" data-target="#deleteModal" wire:click.prevent='delete({{ $category->id }})'><i class="typcn typcn-trash"></i></button>
                                    @endcan
                                    @can('حالة القسم')
                                    <button class="btn btn-info btn-icon" data-toggle="modal" data-target="#statusModel" wire:click.prevent='status({{ $category->id }})'><i class="fa fa-check"></i></button>
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
                        {{ $categories->links() }} 
                    </ul>
                </div>
            </div>
        </div>
    </div>


</div>