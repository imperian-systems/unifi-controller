<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use ImperianSystems\UnifiController\Controllers\UnifiDeviceController;
use ImperianSystems\UnifiController\Controllers\InformController;

Route::group(['middleware'=>'api' ], function () {
    Route::post('/inform', 'ImperianSystems\UnifiController\Controllers\InformController@inform');
});

Route::group(['middleware'=>config("unifi-controller.middleware"), 'prefix'=>'api' ], function () {
    Route::resource('device', UnifiDeviceController::class);
});
