<div class="col-12 col-xs-12 col-sm-12 col-md-9 col-lg-9 col-xl-9">
    <div class="row row-sm">

        <div class="col-sm-12 col-md-64 col-lg-4 col-xl-4">
            <div class="card ">
                <div class="card-body">
                    <div class="card-widget">
                        <h6 class="mb-2">إجمالي طلبات</h6>
                        <h2 class="text-right "><i class="fa fa-cart-plus icon-size float-left text-success"></i><span>{{ \App\Models\Order::where('created_at', 'like', '%'.date('Y-m-d').'%')->where('user_id', $user->id)->count() }}</span></h2>
                        <p class="mb-0">مبيعات اليوم<span class="float-left">{{ number_format(\App\Models\Order::where('created_at', 'like', '%'.date('Y-m-d').'%')->where('user_id', $user->id)->sum('amount'), $setting->price)}}</span></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-64 col-lg-4 col-xl-4">
            <div class="card ">
                <div class="card-body">
                    <div class="card-widget">
                        <h6 class="mb-2">إجمالي طلبات</h6>
                        <h2 class="text-right "><i class="fa fa-cart-plus icon-size float-left text-success"></i><span>{{ \App\Models\Order::where('created_at', 'like', '%'.date('Y-m').'%')->where('user_id', $user->id)->count() }}</span></h2>
                        <p class="mb-0">مبيعات الشهر<span class="float-left">{{ number_format(\App\Models\Order::where('created_at', 'like', '%'.date('Y-m').'%')->where('user_id', $user->id)->sum('amount'), $setting->price)}}</span></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-64 col-lg-4 col-xl-4">
            <div class="card ">
                <div class="card-body">
                    <div class="card-widget">
                        <h6 class="mb-2">إجمالي طلبات</h6>
                        <h2 class="text-right "><i class="fa fa-cart-plus icon-size float-left text-success"></i><span>{{ \App\Models\Order::where('created_at', 'like', '%'.date('Y').'%')->where('user_id', $user->id)->count() }}</span></h2>
                        <p class="mb-0">مبيعات السنه<span class="float-left">{{ number_format(\App\Models\Order::where('created_at', 'like', '%'.date('Y').'%')->where('user_id', $user->id)->sum('amount'), $setting->price)}}</span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            {{-- <div class="tabs-menu ">
                <!-- Tabs -->
                <ul class="nav nav-tabs profile navtab-custom panel-tabs">
                    <li class="active">
                        <a href="#orders" data-toggle="tab" aria-expanded="true"> <span class="visible-xs"><i class="fa fa-cart-plus tx-16 mr-1"></i></span> <span class="hidden-xs">الطلبات</span> </a>
                    </li>
                    <li class="">
                        <a href="#settings" data-toggle="tab" aria-expanded="false"> <span class="visible-xs"><i class="fa fa-cog tx-16 mr-1"></i></span> <span class="hidden-xs">الاعدادات</span> </a>
                    </li>
                </ul>
            </div> --}}
            {{-- <div class="tab-content border-left border-bottom border-right border-top-0 p-4">

                <div class="tab-pane active" id="orders"> --}}

{{--                     
                    <div class="row row-sm">
                        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1 mg-t-20 mg-lg-t-0">
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
                                            <option value="barcode">رقم الفاتورة</option>
                                            <option value="created_at">التاريخ</option>
                                            <option value="amount">المبلغ</option>
                                            <option value="customer_id">العميل</option>

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
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="typcn typcn-calendar-outline tx-24 lh--9 op-6"></i>
                                                </div>
                                            </div><input class="form-control" id="" placeholder="YYYY-MM-DD" type="date" wire:model="searchDate">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 mg-t-20 mg-lg-t-0">
                            <div class="card">
                                <div class="card-body p-2">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="بحث ......" wire:model="searchTerm">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div> --}}


                    {{-- <div class="card">

                        <div class="card-body">
                            <div class="table-responsive text-center">
                                <table class="table" id="">
                                    <thead>
                                        <tr>
                                            <th class="wd-5p bg-gray-100 py-2 tx-20">#</th>
                                            <th class="wd-10p py-2 tx-20">التاريخ</th>
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
                                                    <button class="btn btn-primary btn-icon" data-toggle="modal" data-target="#viewModel" wire:click.prevent='view({{ $order->id }})' ><i class="typcn typcn-eye"></i></button>
                                                    <button class="btn btn-success btn-icon" data-toggle="modal" data-target="#updateModal" wire:click.prevent='view({{ $order->id }})'  ><i class="typcn typcn-edit"></i></button>
                                                    <button class="btn btn-danger btn-icon" data-toggle="modal" data-target="#deleteModal" wire:click.prevent='delete({{ $order->id }})'><i class="typcn typcn-trash"></i></button>
                                                    <button class="btn btn-info btn-icon" data-toggle="modal" data-target="#statusModel" wire:click.prevent='status({{ $order->id }})'><i class="fa fa-check"></i></button>

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
                    </div> --}}



                {{-- </div>

                
                <div class="tab-pane" id="settings"> --}}
                    {{-- <form> --}}
                        
                        <div class="mb-4 main-content-label">الأسم</div>
                        <div class="form-group ">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label">الأسم</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control"  placeholder="الأسم" wire:model="name" wire:keydown.enter="editName()">
                                    @error('name')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                                </div>
                            </div>
                        </div>


                        <div class="mb-4 main-content-label">معلومات الأتصال</div>
                        <div class="form-group ">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label">البريد الإلكتروني</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="email" class="form-control"  placeholder="البريد الإلكتروني" wire:model="email" wire:keydown.enter="editEmail()">
                                    @error('email')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group ">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label">الهاتف</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control"  placeholder="الهاتف" wire:model="phone" wire:keydown.enter="editPhone()">
                                    @error('phone')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                                </div>
                            </div>
                        </div>

                        <form role="form">
                            <div class="mb-4 main-content-label">تغيير كلمة المرور</div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="form-label">كلمة المرور القديمة</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="password" class="form-control" id="old_password" name="old_password" wire:model="old_password" >
                                        @error('old_password')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="form-label">كلمة المرور</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="password" class="form-control" id="new_password" name="new_password" wire:model="new_password" >
                                        @error('new_password')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                            </div>
        
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="form-label">تأكيد كلمة المرور</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" wire:model="confirm_password"  >
                                        @error('confirm_password')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                    </div>
                                    <div class="col-md-9">
                                        <button class="btn btn-primary waves-effect waves-light w-md" type="button" wire:click.prevent="updatePassword()">تغيير كلمة المرور</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    {{-- </form> --}}
                {{-- </div>
            </div> --}}
        </div>
    </div>
    
</div>