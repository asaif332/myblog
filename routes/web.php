<?php

Route::get('/test', function () {
    return App\User :: find(2)->profile;
});

Route::get('/' , 'FrontEndController@index')->name('index');
Route:: get('/posts/{slug}' , 'FrontEndController@postSingle')->name('posts.single');
Route:: get('/categories/{id}' , 'FrontEndController@categorySingle')->name('categories.single');
Route:: get('/tags/{id}' , 'FrontEndController@tagSingle')->name('tags.single');
Route:: get('/results' , 'FrontEndController@result')->name('result');
Route:: post('/subscribe' , 'FrontEndController@subscribe')->name('subscribe');

Auth::routes();




Route::group(['prefix' => 'admin' ,'middleware' => 'auth'], function() {
    Route::get('/home', 'HomeController@index')->name('home');

    Route :: get('/posts/trash' , 'PostsController@trash')->name('posts.trash');
    Route :: get('/posts/restore/{id}' , 'PostsController@restore')->name('posts.restore');
    Route :: get('/posts/kill/{id}' , 'PostsController@kill')->name('posts.kill');
    Route :: get('/users/admin/{id}' , 'UsersController@admin')->name('users.admin');
    Route :: get('/users/not_admin/{id}' , 'UsersController@not_admin')->name('users.not.admin');
    Route :: get('/users/profile' , 'ProfilesController@index')->name('users.profile');
    Route :: post('/users/profile/update' , 'ProfilesController@update')->name('users.profile.update');
    Route :: get('/settings' , 'SettingsController@index')->name('settings.index');
    Route :: post('/settings/update' , 'SettingsController@update')->name('settings.update');

    Route::resource('posts', 'PostsController');
    Route :: resource('users' , 'UsersController');
    Route :: resource('tags' , 'TagsController');
    Route :: resource('categories' , 'CategoriesController');
});



