<?php
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\CatalogController;
use \App\Http\Controllers\CustomerController;
use \App\Http\Controllers\OrderController;
use \App\Http\Controllers\ProductController;
use \App\Http\Controllers\TransactionController;

Route::get('/', function () {
    return view('admin.home');
});


Route::group(['prefix'=>'catalogs', 'middleware'=>'isAdmin'], function() {
    Route::get('/create', [CatalogController::class, 'form']);   //hiển thị giao diện
    Route::post('/create', [CatalogController::class, 'create']);    //post dữ liệu từ input
    Route::get('/edit/{id}', [CatalogController::class, 'edit']);
    Route::put('/edit/{catalog:idCatalog}', [CatalogController::class, 'update']);
    Route::delete('/delete/{catalog}', [CatalogController::class, 'delete']);
    Route::get('/list', [CatalogController::class, 'list']);
});

Route::group(['prefix'=>'customer', 'middleware'=>'isAdmin'], function() {
    Route::get('/create', [CustomerController::class, 'form']);   //hiển thị giao diện
    Route::post('/create', [CustomerController::class, 'create']);    //post dữ liệu từ input
    Route::get('/edit/{id}', [CustomerController::class, 'edit']);
    Route::put('/edit/{customer:idCustomer}', [CustomerController::class, 'update']);
    Route::delete('/delete/{customer}', [CustomerController::class, 'delete']);
    Route::get('/list', [CustomerController::class, 'list']);
});

Route::group(['prefix'=>'order', 'middleware'=>'isAdmin'], function() {
    Route::get('/create', [OrderController::class, 'form']);   //hiển thị giao diện
    Route::post('/create', [OrderController::class, 'create']);    //post dữ liệu từ input
    Route::get('/edit/{id}', [OrderController::class, 'edit']);
    Route::put('/edit/{order:idOrder}', [OrderController::class, 'update']);
    Route::delete('/delete/{order}', [OrderController::class, 'delete']);
    Route::get('/list', [OrderController::class, 'list']);
});

Route::group(['prefix'=>'products', 'middleware'=>'isAdmin'], function() {
    Route::get('/create', [ProductController::class, 'form']);   //hiển thị giao diện
    Route::post('/create', [ProductController::class, 'create']);    //post dữ liệu từ input
    Route::get('/edit/{id}', [ProductController::class, 'edit']);
    Route::put('/edit/{product:idProduct}', [ProductController::class, 'update']);
    Route::delete('/delete/{product}', [ProductController::class, 'delete']);
    Route::get('/list', [ProductController::class, 'list']);
});

Route::group(['prefix'=>'transactions', 'middleware'=>'isAdmin'], function() {
    Route::get('/create', [TransactionController::class, 'form']);   //hiển thị giao diện
    Route::post('/create', [TransactionController::class, 'create']);    //post dữ liệu từ input
    Route::get('/edit/{id}', [TransactionController::class, 'edit']);
    Route::put('/edit/{transaction:idTransaction}', [TransactionController::class, 'update']);
    Route::delete('/delete/{transaction}', [TransactionController::class, 'delete']);
    Route::get('/list', [TransactionController::class, 'list']);
});

