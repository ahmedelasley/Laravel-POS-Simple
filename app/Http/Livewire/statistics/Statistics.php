<?php

namespace App\Http\Livewire\Statistics;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Setting;
use Livewire\Component;
use App\Models\Customer;
use App\Models\Supplier;


class Statistics extends Component
{





    public function render()
    {
        $setting = Setting::first();

        $customers = Customer::count();
        $orders = Order::count();
        $products = Product::count();
        $suppliers = Supplier::count();

        $ordersCountYear = Order::where('created_at', 'like', '%'.date('Y').'%')->count();

        $ordersCount1 = Order::where('created_at', 'like', '%'.date('Y').'-01%')->count();
        $ordersCount2 = Order::where('created_at', 'like', '%'.date('Y').'-02%')->count();
        $ordersCount3 = Order::where('created_at', 'like', '%'.date('Y').'-03%')->count();
        $ordersCount4 = Order::where('created_at', 'like', '%'.date('Y').'-04%')->count();
        $ordersCount5 = Order::where('created_at', 'like', '%'.date('Y').'-05%')->count();
        $ordersCount6 = Order::where('created_at', 'like', '%'.date('Y').'-06%')->count();
        $ordersCount7 = Order::where('created_at', 'like', '%'.date('Y').'-07%')->count();
        $ordersCount8 = Order::where('created_at', 'like', '%'.date('Y').'-08%')->count();
        $ordersCount9 = Order::where('created_at', 'like', '%'.date('Y').'-09%')->count();
        $ordersCount10 = Order::where('created_at', 'like', '%'.date('Y').'-10%')->count();
        $ordersCount11 = Order::where('created_at', 'like', '%'.date('Y').'-11%')->count();
        $ordersCount12 = Order::where('created_at', 'like', '%'.date('Y').'-12%')->count();
        
        $chartjsCount = app()->chartjs
                        ->name('barChartCount')
                        ->type('bar')
                        ->size(['width' => 500, 'height' => 200])
                        ->labels(['يناير','فبراير','مارس','أبريل','مايو','يونيو','يوليو','أغسطس','سبتمبر','أكتوبر','نوفمبر','ديسمبر'])
                        ->datasets([
                                    [
                                        "label" =>"عددالفواتير",
                                        'backgroundColor' => ['#0000ff', '#0000ff', '#0000ff', '#0000ff', '#0000ff', '#0000ff', '#0000ff', '#0000ff', '#0000ff', '#0000ff', '#0000ff', '#0000ff'],
                                        'data' => [
                                            $ordersCount1,
                                            $ordersCount2,
                                            $ordersCount3,
                                            $ordersCount4,
                                            $ordersCount5,
                                            $ordersCount6,
                                            $ordersCount7,
                                            $ordersCount8,
                                            $ordersCount9,
                                            $ordersCount10,
                                            $ordersCount11,
                                            $ordersCount12,
                                        ]
                                    ],
                                ])
                        ->options([]);



        $ordersSumYear = Order::where('created_at', 'like', '%'.date('Y').'%')->sum('amount');

        $ordersSum1 = Order::where('created_at', 'like', '%'.date('Y').'-01%')->sum('amount');
        $ordersSum2 = Order::where('created_at', 'like', '%'.date('Y').'-02%')->sum('amount');
        $ordersSum3 = Order::where('created_at', 'like', '%'.date('Y').'-03%')->sum('amount');
        $ordersSum4 = Order::where('created_at', 'like', '%'.date('Y').'-04%')->sum('amount');
        $ordersSum5 = Order::where('created_at', 'like', '%'.date('Y').'-05%')->sum('amount');
        $ordersSum6 = Order::where('created_at', 'like', '%'.date('Y').'-06%')->sum('amount');
        $ordersSum7 = Order::where('created_at', 'like', '%'.date('Y').'-07%')->sum('amount');
        $ordersSum8 = Order::where('created_at', 'like', '%'.date('Y').'-08%')->sum('amount');
        $ordersSum9 = Order::where('created_at', 'like', '%'.date('Y').'-09%')->sum('amount');
        $ordersSum10 = Order::where('created_at', 'like', '%'.date('Y').'-10%')->sum('amount');
        $ordersSum11 = Order::where('created_at', 'like', '%'.date('Y').'-11%')->sum('amount');
        $ordersSum12 = Order::where('created_at', 'like', '%'.date('Y').'-12%')->sum('amount');
        
        $chartjsSum = app()->chartjs
                        ->name('barChartSum')
                        ->type('bar')
                        ->size(['width' => 500, 'height' => 200])
                        ->labels(['يناير','فبراير','مارس','أبريل','مايو','يونيو','يوليو','أغسطس','سبتمبر','أكتوبر','نوفمبر','ديسمبر'])
                        ->datasets([
                                    [
                                        "label" =>"المبالغ",
                                        'backgroundColor' => ['#3cb371', '#3cb371', '#3cb371', '#3cb371', '#3cb371', '#3cb371', '#3cb371', '#3cb371', '#3cb371', '#3cb371', '#3cb371', '#3cb371'],
                                        'data' => [
                                            $ordersSum1,
                                            $ordersSum2,
                                            $ordersSum3,
                                            $ordersSum4,
                                            $ordersSum5,
                                            $ordersSum6,
                                            $ordersSum7,
                                            $ordersSum8,
                                            $ordersSum9,
                                            $ordersSum10,
                                            $ordersSum11,
                                            $ordersSum12,
                                        ]
                                    ]
                                ])
                        ->options([]);

        return view('livewire.statistics.statistics',[
            'setting' => $setting,
            'customers' => $customers,
            'orders' => $orders,
            'products' => $products,
            'suppliers' => $suppliers,
            'ordersCountYear' => $ordersCountYear,
            'chartjsCount' => $chartjsCount,
            'ordersSumYear' => $ordersSumYear,
            'chartjsSum' => $chartjsSum,
        ]);
    }
}
