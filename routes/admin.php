<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

// Login Routes
Route::group(['namespace' => 'Admin','middleware' => 'guest:admin'],function (){
    Route::get('login','LoginController@getLogin')->name('get.admin.login');
    Route::post('login','LoginController@login')->name('admin.login');
});
Route::get('/',function () {
    return redirect()->route('admin.dashboard');
});
// Admin Routes
Route::group(['namespace' => 'Admin','middleware' => 'auth:admin', 'as' => 'admin.'],function (){

    // Dashboard Page
    Route::get('/dashboard','DashboardController@index')->name('dashboard');

    /* Users */
    Route::get('/users', function () {
        return redirect()->route('admin.users', 'resume');
    });

    // All Users
    Route::get('/users/{type}', 'UsersController@index')->name('users');
    // Show User
    Route::get('/user/{id}', 'UsersController@show')->name('users.show');
    // Block User
    Route::post('/user/block', 'UsersController@block')->name('users.block');
    // Unblock User
    Route::post('/user/unblock', 'UsersController@unblock')->name('users.unblock');
    // Delete User
    Route::post('/user/delete', 'UsersController@delete')->name('users.delete');


    // FAQ
    Route::get('/faq', 'FaqController@index')->name('faq.index');
    // Add FAQ
    Route::get('/faq/add', 'FaqController@add')->name('faq.add');
    // Save FAQ
    Route::post('/faq/add', 'FaqController@save')->name('faq.save');
    // Edit FAQ
    Route::get('/faq/edit/{id}', 'FaqController@edit')->name('faq.edit');
    // Update FAQ
    Route::post('/faq/update', 'FaqController@update')->name('faq.update');
    // Delete FAQ
    Route::post('/faq/delete', 'FaqController@delete')->name('faq.delete');

    // Services
    Route::get('/services', 'ServicesController@index')->name('services.index');
    // Save Service
    Route::post('/services', 'ServicesController@save')->name('services.save');
    // Edit Service
    Route::get('/services/{id}/edit', 'ServicesController@edit')->name('services.edit');
    // Update Service
    Route::post('/services/update', 'ServicesController@update')->name('services.update');
    // Delete Service
    Route::post('/services/delete', 'ServicesController@delete')->name('services.delete');

    // Settings
    Route::get('/settings', 'SettingsController@index')->name('settings.index');
    // Settings Update
    Route::post('/settings', 'SettingsController@update')->name('settings.update');


    /* Admin Area */

    // Profile Page
    Route::get('/profile','LoginController@profile')->name('profile');
    // Profile Edit Page
    Route::post('/profile','LoginController@profileUpdate')->name('profile.update');
    // Logout
    Route::get('/logout', 'LoginController@logout')->name('logout');
});
