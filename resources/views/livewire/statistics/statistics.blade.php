<div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">

    
    <div class="row row-sm">
        <div class="col-lg-6 col-xl-3 col-md-6 col-12">
            <div class="card bg-primary-gradient text-white ">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="icon1 mt-2 text-center">
                                <i class="fe fe-users tx-40"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mt-0 text-center">
                                <span class="text-white tx-16 tx-bold">العملاء</span>
                                <h2 class="text-white mb-0">{{ $customers }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xl-3 col-md-6 col-12">
            <div class="card bg-danger-gradient text-white">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="icon1 mt-2 text-center">
                                <i class="fe fe-shopping-cart tx-40"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mt-0 text-center">
                                <span class="text-white tx-16 tx-bold">الطلبات</span>
                                <h2 class="text-white mb-0">{{ $orders }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xl-3 col-md-6 col-12">
            <div class="card bg-success-gradient text-white">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="icon1 mt-2 text-center">
                                <i class="fe fe-tag tx-40"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mt-0 text-center">
                                <span class="text-white tx-16 tx-bold">المنتجات</span>
                                <h2 class="text-white mb-0">{{ $products }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xl-3 col-md-6 col-12">
            <div class="card bg-warning-gradient text-white">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="icon1 mt-2 text-center">
                                <i class="fa fa-building tx-40"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mt-0 text-center">
                                <span class="text-white tx-16 tx-bold">الموردين</span>
                                <h2 class="text-white mb-0">{{ $suppliers }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row row-cards row-deck">
        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="card-title pb-0 mb-2 tx-20 tx-bold">المبيعات</div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col text-center">
                            <label class="tx-18">اليوم</label>
                            <p class="font-weight-bold tx-20">{{ \App\Models\Order::where('created_at', 'like', '%'.date('Y-m-d').'%')->count() }}</p>
                        </div><!-- col -->
                        <div class="col border-right text-center">
                            <label class="tx-18">هذا الشهر</label>
                            <p class="font-weight-bold tx-20">{{ \App\Models\Order::where('created_at', 'like', '%'.date('Y-m').'%')->count() }}</p>
                        </div><!-- col -->
                        <div class="col border-right text-center">
                            <label class="tx-18">هذه السنة</label>
                            <p class="font-weight-bold tx-20">{{ \App\Models\Order::where('created_at', 'like', '%'.date('Y').'%')->count() }}</p>
                        </div><!-- col -->
                    </div><!-- row -->


                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="card-title pb-0 mb-2 tx-20 tx-bold">المبيعات</div>
                </div>
                <div class="card-body">
                    <div class="row">

                        <div class="col text-center">
                            <label class="tx-18">اليوم</label>
                            <p class="font-weight-bold tx-20">{{ number_format(\App\Models\Order::where('created_at', 'like', '%'.date('Y-m-d').'%')->sum('amount'), $setting->price)}}</p>
                        </div><!-- col -->
                        <div class="col border-right text-center">
                            <label class="tx-18">هذا الشهر</label>
                            <p class="font-weight-bold tx-20">{{ number_format(\App\Models\Order::where('created_at', 'like', '%'.date('Y-m').'%')->sum('amount'), $setting->price)}}</p>
                        </div><!-- col -->
                        <div class="col border-right text-center">
                            <label class="tx-18">هذه السنة</label>
                            <p class="font-weight-bold tx-20">{{ number_format(\App\Models\Order::where('created_at', 'like', '%'.date('Y').'%')->sum('amount'), $setting->price) }}</p>
                        </div><!-- col -->
                    </div><!-- row -->

                </div>
            </div>
        </div>

    </div>

    <div class="row row-cards row-deck">

        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
            <div class="card">
                <div class="card-header bg-transparent pd-b-0 pd-t-20 bd-b-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mb-0">أحصائيات الطلبات خلال العام ({{ date('Y')}})</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                    {{-- <p class="tx-12 text-muted mb-0">Order Status and Tracking. Track your order from ship date to arrival. To begin, enter your order number.</p> --}}
                </div>
                <div class="card-body">
                    <div class="total-revenue">
                        <div>
                            <h4>{{ $ordersCountYear }}</h4>
                            <label><span class="bg-primary"></span>عددالفواتير لعام ({{ date('Y')}})</label>
                        </div>
                    </div>
                    <div class="sales-bar mt-4">
                        {!! $chartjsCount->render() !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
            <div class="card">
                <div class="card-header bg-transparent pd-b-0 pd-t-20 bd-b-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mb-0">أحصائيات الطلبات خلال العام ({{ date('Y')}})</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                    {{-- <p class="tx-12 text-muted mb-0">Order Status and Tracking. Track your order from ship date to arrival. To begin, enter your order number.</p> --}}
                </div>
                <div class="card-body">
                    <div class="total-revenue">
                        <div>
                            <h4>{{ number_format($ordersSumYear, $setting->price) }}</h4>
                            <label><span class="bg-primary"></span>المبالغ المحصلة لعام ({{ date('Y')}})</label>
                        </div>
                    </div>
                    <div class="sales-bar mt-4">
                        {!! $chartjsSum->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>