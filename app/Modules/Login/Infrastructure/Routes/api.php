<?php

use App\Modules\Login\Http\Controllers\AuthenticateController;

Route::group(attributes: [], routes: function () {
    Route::post('/login', [AuthenticateController::class, 'login']);
});
