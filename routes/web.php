<?php
Route::model('account', App\Models\Account::class);
Route::model('character', App\Models\Character::class);


Route::get('login', 'LoginController')->name('login');
Route::get('oauth/discord/redirect', 'LoginController@discordRedirect')->name('oauth.discord.redirect');

Route::get('account/search', 'AccountController@search')->name('account.search');

Route::middleware('auth')->group(function() {
    Route::view('/', 'welcome');

    Route::get('account/{account}', 'AccountController')->name('account');

    Route::get('master/cosplay', 'MasterCosplayController')->name('master.cosplay');
    Route::put('master/cosplay', 'MasterCosplayController@pin')->name('master.cosplay.pin');
    Route::get('master/cosplay/search', 'MasterCosplayController@search')->name('master.cosplay.search');

    Route::get('shop/monitoring', 'ShopController')->name('shop.monitoring');
    Route::post('shop/monitoring/create', 'ShopController@create')->name('shop.monitoring.create');

    Route::get('setting/helper', 'SettingController')->name('setting.helper');
    Route::get('setting/helper/{character}', 'SettingController@accessory')->name('character.accessory');

    Route::get('library', 'LibraryController')->name('library.home');

    Route::prefix('api')->name('api.')->group(function() {
        Route::post('account/create', 'CrawController@character');
        Route::post('character/{id}/description', 'CharacterController@setDescription');
        Route::post('content/week', 'ContentContoller@week')->name('account');
        Route::post('content/day', 'ContentContoller@day')->name('account');
        Route::post('content/rest', 'ContentContoller@rest')->name('account');
        Route::post('fcm/init', 'FcmToken@put');
    });

    Route::get('party', 'PartyController')->name('party.home');
    Route::post('party/create', 'PartyController@create')->name('party.create');
    Route::get('party/account/{party}', 'PartyController@partyAccount');
    Route::get('party/account/{party}/character/{account}', 'PartyController@partyCharacter');
    Route::post('party/{party}/member', 'PartyController@addMembers');
});
