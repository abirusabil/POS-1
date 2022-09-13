<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/show', [\App\Http\Controllers\HomeController::class, 'show']);
Route::get('/showOne', [\App\Http\Controllers\HomeController::class, 'getOne']);
Route::get('/create', [\App\Http\Controllers\HomeController::class, 'create']);
Route::get('/updateProduct', [\App\Http\Controllers\HomeController::class, 'updateProduct']);
Route::get('/getCategory', [\App\Http\Controllers\HomeController::class, 'getCategory']);
Route::get('/createVarian', [\App\Http\Controllers\HomeController::class, 'createVarian']);
Route::get('/showVarian', [\App\Http\Controllers\HomeController::class, 'showVarian']);
Route::get('/createAttribute', [\App\Http\Controllers\HomeController::class, 'createAttribute']);
Route::get('/createOption', [\App\Http\Controllers\HomeController::class, 'createOption']);
Route::get('/order', [\App\Http\Controllers\HomeController::class, 'order']);
Route::get('/orderCart', [\App\Http\Controllers\HomeController::class, 'orderCart']);
Route::get('/customer', [\App\Http\Controllers\HomeController::class, 'showCustomer']);
Route::get('/report', [\App\Http\Controllers\HomeController::class, 'report']);
Route::get('/showAttribute', [\App\Http\Controllers\HomeController::class, 'showAttribute']);

Route::middleware(['auth'])->group(function () {

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
    Route::get('/pos', [App\Http\Controllers\HomeController::class, 'pos'])->name('pos');
    Route::post('/posSearch/', [App\Http\Controllers\HomeController::class, 'posSearch'])->name('pos.search');
    Route::get('/pos/variable/{id}', [App\Http\Controllers\HomeController::class, 'posVariable'])->name('posVariable');
    //Route::get('/expense', [App\Http\Controllers\HomeController::class, 'expense'])->name('expense');
    Route::get('/home/{filter}', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboardFilter');
    Route::get('actionCart/{name}/{price}/{product_id}/{variant_id}', [App\Http\Controllers\HomeController::class, 'actionCart'])->name('actionCart');

    Route::post('/updateQty', [\App\Http\Controllers\HomeController::class, 'updateQty'])->name('updateQty');
    Route::get('/totalPrice', [\App\Http\Controllers\HomeController::class, 'totalPrice'])->name('totalPrice');

    Route::post('/createCustomer', [\App\Http\Controllers\HomeController::class, 'createCustomer'])->name('createCustomer');
    Route::post('/createOrder', [\App\Http\Controllers\HomeController::class, 'createOrder'])->name('createOrder');
    Route::get('/printInvoice', [\App\Http\Controllers\HomeController::class, 'printInvoice'])->name('printInvoice');

    //Route::group(['prefix'=>'products','as'=>'products.','middleware'=>'auth'], function(){
    Route::group(['prefix' => 'products', 'as' => 'products.', 'middleware' => 'auth'], function () {
        Route::get('/import', [App\Http\Controllers\ProductController::class, 'import'])->name('import');
        Route::get('/', [App\Http\Controllers\ProductController::class, 'index'])->name('index');
        Route::get('/destroy/{id}', [App\Http\Controllers\ProductController::class, 'destroy'])->name('destroys');
        Route::get('/a/create', [\App\Http\Controllers\ProductController::class, 'create'])->name('create');
        Route::post('/a/create/post', [\App\Http\Controllers\ProductController::class, 'store'])->name('store');
        // Route::get('/', [App\Http\Controllers\ProductController::class, 'index'])->name('index');
    });


    Route::group(['prefix' => 'categories', 'as' => 'categories.', 'middleware' => 'auth'], function () {
        Route::get('/import', [App\Http\Controllers\CategoryController::class, 'import'])->name('import');
        Route::get('/{page}', [App\Http\Controllers\CategoryController::class, 'index'])->name('index');
        Route::get('/destroy/{id}', [App\Http\Controllers\CategoryController::class, 'destroy'])->name('destroys');
        Route::get('/a/create', [\App\Http\Controllers\CategoryController::class, 'create'])->name('create');
        Route::post('/store', [\App\Http\Controllers\CategoryController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [\App\Http\Controllers\CategoryController::class, 'edit'])->name('edit');
        Route::post('/edit/{id}', [\App\Http\Controllers\CategoryController::class, 'update'])->name('update');

        Route::get('/', [App\Http\Controllers\CategoryController::class, 'index'])->name('index');
    });
    Route::get('expense/destroys/{id}', [App\Http\Controllers\ExpenseController::class, 'destroy'])->name('expense.destroys');

    Route::resource('expense',\App\Http\Controllers\ExpenseController::class);
});

