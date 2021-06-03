<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::post('users/media', 'UsersController@storeMedia')->name('users.storeMedia');
    Route::post('users/ckmedia', 'UsersController@storeCKEditorImages')->name('users.storeCKEditorImages');
    Route::resource('users', 'UsersController');

    // Business Account
    Route::delete('business-accounts/destroy', 'BusinessAccountController@massDestroy')->name('business-accounts.massDestroy');
    Route::post('business-accounts/media', 'BusinessAccountController@storeMedia')->name('business-accounts.storeMedia');
    Route::get('business-accounts/most-active', 'BusinessAccountController@mostActive')->name('business-accounts.mostActive');
    Route::resource('business-accounts', 'BusinessAccountController');

    // Business Users

    Route::group(['as' => 'business-users.', 'prefix' =>  'business-users'],function (){
        Route::delete('{org_user}', 'BusinessUserController@destroy')->name('destroy');
        Route::post('status/{org_user}', 'BusinessUserController@status')->name('status');
    });

    // Employee
    Route::delete('employees/destroy', 'EmployeeController@massDestroy')->name('employees.massDestroy');
    Route::post('employees/parse-csv-import', 'EmployeeController@parseCsvImport')->name('employees.parseCsvImport');
    Route::post('employees/process-csv-import', 'EmployeeController@processCsvImport')->name('employees.processCsvImport');
    Route::resource('employees', 'EmployeeController');

    // Attendance
    Route::resource('attendances', 'AttendanceController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // Business Location
    Route::delete('business-locations/destroy', 'BusinessLocationController@massDestroy')->name('business-locations.massDestroy');
    Route::post('business-locations/media', 'BusinessLocationController@storeMedia')->name('business-locations.storeMedia');
    Route::post('business-locations/ckmedia', 'BusinessLocationController@storeCKEditorImages')->name('business-locations.storeCKEditorImages');
    Route::resource('business-locations', 'BusinessLocationController');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
