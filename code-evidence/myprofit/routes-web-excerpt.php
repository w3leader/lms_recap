<?php

Auth::routes(['register' => false]);
Auth::routes(['verify' => true]);
Auth::routes(['reset' => false]);

Route::get('/', 'AuthReg\AuthController@authPage')->name('auth');
Route::get('/forgot', 'WebviewerController@forgot')->name('forgot');
Route::get('/login', 'WebviewerController@login')->name('login');
Route::get('/home', 'HomeController@index')->name('home');

// Full admin group.
Route::middleware(['admin'])->group(function () {
    Route::get('/member', 'WebviewerController@member')->name('member');
    Route::post('/member-list', 'DataTableController@memberlist')->name('member-list');
    Route::post('/instUser', 'memberController@instUser')->name('instUser');
    Route::post('/getUserInfo', 'memberController@getUserInfo')->name('getUserInfo');
    Route::post('/edtUser', 'memberController@edtUser')->name('edtUser');
    Route::post('/rmtUser', 'memberController@rmtUser')->name('rmtUser');

    Route::get('/category-shipping', 'WebviewerController@categoryShipping')->name('category-shipping');
    Route::post('/category-list', 'DataTableController@categoryTable')->name('category-list');
    Route::post('/instCategory', 'ShipCategoryController@instCategory')->name('instCategory');
    Route::post('/getCategory', 'ShipCategoryController@getCategory')->name('getCategory');
    Route::post('/edtCategory', 'ShipCategoryController@edtCategory')->name('edtCategory');
    Route::post('/rmtCategory', 'ShipCategoryController@rmtCategory')->name('rmtCategory');

    Route::post('/report-datetime', 'ReportController@reportDatetime')->name('report-datetime');
    Route::post('/report-alltime', 'ReportController@reportAll')->name('report-alltime');
    Route::post('/report-catereport', 'ReportController@reportCateReport')->name('report-catereport');

    Route::get('/bigpackstock', 'WebviewerController@bigpackstock')->name('bigpackstock');
    Route::post('/bigpackstock-search', 'BigStockController@index')->name('bigpackstock-search');
    Route::post('/bigpackstock-store', 'BigStockController@store')->name('bigpackstock-store');
    Route::post('/bigpackstock-table', 'BigStockController@bigpackstock_log')->name('bigpackstock-table');

    Route::get('/products-rm', 'WebviewerController@productsRm')->name('products');
    Route::post('/all-product-table-rm', 'DataTableController@productRemoveList')->name('all-product-table-rm');
    Route::post('/product-restore', 'ProductController@restrProduct')->name('product-restore');
});

// Page admin group.
Route::group(['middleware' => ['pageAdmin']], function () {
    Route::get('/admincustomer', 'WebviewerController@admincustomer')->name('admincustomer');
    Route::post('/admincustomer-list-table', 'DataTableController@customerlist')->name('admincustomer-list-table');
    Route::post('/search-customer', 'CustomerController@getCustomerType')->name('search-customer');
});

// Stock and reporting role group.
Route::group(['middleware' => ['checkRole']], function () {
    Route::get('/set-product', 'SetProductController@index')->name('set-product');
    Route::post('/table-set-product', 'DataTableController@setProduct')->name('table-set-product');
    Route::post('file-import-set-product', 'SetProductController@fileImport')->name('set-product-import');
    Route::patch('update-set-product/{id}', 'SetProductController@update')->name('set-product.update');
    Route::delete('delete-set-product/{id}', 'SetProductController@destroy')->name('set-product.destroy');
});
