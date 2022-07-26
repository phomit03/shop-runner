<?php
Route::group(['prefix'=>'catalogs', 'middleware'=>'isAdmin'], function() {

});

Route::group(['prefix'=>'customer', 'middleware'=>'isAdmin'], function() {

});

Route::group(['prefix'=>'order', 'middleware'=>'isAdmin'], function() {

});

Route::group(['prefix'=>'products', 'middleware'=>'isAdmin'], function() {

});

Route::group(['prefix'=>'transactions', 'middleware'=>'isAdmin'], function() {

});

