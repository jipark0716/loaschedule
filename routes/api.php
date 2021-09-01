<?php
Route::post('account/create', 'CrawController@character');
Route::post('content/week', 'ContentContoller@week')->name('account');
Route::post('content/day', 'ContentContoller@day')->name('account');
Route::post('content/rest', 'ContentContoller@rest')->name('account');
Route::post('fcm/init', 'FcmToken@put');
