<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SupplierController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('/login');
// });

// Auth::routes();
Auth::routes(['register' => false]);

Route::group(['middleware' => ['auth']], function() {

    Route::resource('/roles','RoleController');
    // Route::resource('/users','UserController');

    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::get('/roles', [RoleController::class, 'index'])->name('roles');
    Route::get('/users', [UserController::class, 'index'])->name('users');

    Route::get('/profile', [UserController::class, 'profile'])->name('profile');

    Route::get('/settings', [SettingController::class, 'index'])->name('settings');
    Route::get('/customers', [CustomerController::class, 'index'])->name('customers');
    Route::get('/suppliers', [SupplierController::class, 'index'])->name('suppliers');
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
    Route::get('/products', [ProductController::class, 'index'])->name('products');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders');
    Route::get('/statistics', [HomeController::class, 'statistics'])->name('statistics');

});


// Route::get('/customers', Customers::class)->name('customers');

// Route::get('/receipt/{id}', [HomeController::class, 'index'])->name('home');
// Route::get('/receipt/{id}', Order::class)->name('receipt');


Route::get('/receipt/{id}', [OrderController::class, 'showReceipt'])->name('receipt');
Route::get('/receipt-client/{barcode}', [OrderController::class, 'showReceiptClient'])->name('receiptClient');
