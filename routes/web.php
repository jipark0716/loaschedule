<?php
Route::model('account', App\Models\Account::class);

Route::view('/', 'welcome');
Route::get('account/{account}', 'AccountController')->name('account');
Route::get('master/cosplay', 'MasterCosplayController')->name('master.cosplay');
Route::put('master/cosplay', 'MasterCosplayController@pin')->name('master.cosplay.pin');
Route::get('master/cosplay/search', 'MasterCosplayController@search')->name('master.cosplay.search');

Route::get('test', function() {
    dd(now()->addDays(-2)->format('YW'));
    return App\Models\Account::find(2)->crawCharacter();
});
