<?php

use App\Http\Controllers\Api\V1\Admin\BlogsController;
use App\Http\Controllers\Api\V1\Admin\EmailController;

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin'], function () {
    //Blogs
    Route::get('topBlogs', [BlogsController::class, 'getTopBlogs']);
    Route::resource('blogs', 'BlogsController');

    //Email
    Route::post('/send-email', [EmailController::class, 'sendEmail']);
});
