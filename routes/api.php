<?php
//
//Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
//    // Permissions
//    Route::apiResource('permissions', 'PermissionsApiController');
//
//    // Roles
//    Route::apiResource('roles', 'RolesApiController');
//
//    // Users
//    Route::post('users/media', 'UsersApiController@storeMedia')->name('users.storeMedia');
//    Route::apiResource('users', 'UsersApiController');
//
//    // Business Account
//    Route::apiResource('business-accounts', 'BusinessAccountApiController');
//
//    // Employee
//    Route::apiResource('employees', 'EmployeeApiController');
//
//    // Attendance
//    Route::apiResource('attendances', 'AttendanceApiController', ['except' => ['store', 'update', 'destroy']]);
//
//    // Business Location
//    Route::post('business-locations/media', 'BusinessLocationApiController@storeMedia')->name('business-locations.storeMedia');
//    Route::apiResource('business-locations', 'BusinessLocationApiController');
//});
