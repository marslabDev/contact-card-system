<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Contact Card
    Route::post('contact-cards/media', 'ContactCardApiController@storeMedia')->name('contact-cards.storeMedia');
    Route::apiResource('contact-cards', 'ContactCardApiController');

    // Social Media
    Route::apiResource('social-media', 'SocialMediaApiController');
});
