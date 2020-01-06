<?php



Auth::routes();

Route::get('user', 'HomeController@index')->name('home');
Route::permanentRedirect('/', 'login');
Route::permanentRedirect('/home', 'user');

Route::group(['middleware'=>['auth']],function(){
    //CREATE REMINDR
    Route::get('create','HomeController@create')->name('create');
    Route::post('create','HomeController@create_remindr')->name('create_remindr');
    
    //EDIT REMINDR
    Route::get('edit','HomeController@edit')->name('edit');
    Route::post('ajaxedit','HomeController@ajax_edit')->name('ajax_edit');
    Route::post('edit','HomeController@edit_remindr')->name('edit_remindr');



    //DELETE REMINDR
    Route::get('delete','HomeController@delete')->name('delete');
    Route::post('delete','HomeController@delete_remindr')->name('delete_remindr');


    //REMINDR HISTORY
    Route::get('history','HomeController@history')->name('history');
    

    //PROFILE
    Route::get('profile','HomeController@profile')->name('profile');
    Route::post('profile','HomeController@profile_remindr')->name('profile_remindr');


    //PASSWORD
    Route::get('password', 'HomeController@password')->middleware(['password.confirm'])->name('password');
    Route::post('password','HomeController@change_pass')->name('change_password');


});

Route::get('time/{id}','HomeController@time');
