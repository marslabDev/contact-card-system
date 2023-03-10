<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Route::get('userVerification/{token}', 'UserVerificationController@approve')->name('userVerification');
Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth', '2fa']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // Contact Card
    Route::delete('contact-cards/destroy', 'ContactCardController@massDestroy')->name('contact-cards.massDestroy');
    Route::post('contact-cards/media', 'ContactCardController@storeMedia')->name('contact-cards.storeMedia');
    Route::post('contact-cards/ckmedia', 'ContactCardController@storeCKEditorImages')->name('contact-cards.storeCKEditorImages');
    Route::post('contact-cards/parse-csv-import', 'ContactCardController@parseCsvImport')->name('contact-cards.parseCsvImport');
    Route::post('contact-cards/process-csv-import', 'ContactCardController@processCsvImport')->name('contact-cards.processCsvImport');
    Route::resource('contact-cards', 'ContactCardController');

    // Social Media
    Route::delete('social-media/destroy', 'SocialMediaController@massDestroy')->name('social-media.massDestroy');
    Route::post('social-media/parse-csv-import', 'SocialMediaController@parseCsvImport')->name('social-media.parseCsvImport');
    Route::post('social-media/process-csv-import', 'SocialMediaController@processCsvImport')->name('social-media.processCsvImport');
    Route::resource('social-media', 'SocialMediaController');

    // Photo
    Route::delete('photos/destroy', 'PhotoController@massDestroy')->name('photos.massDestroy');
    Route::post('photos/media', 'PhotoController@storeMedia')->name('photos.storeMedia');
    Route::post('photos/ckmedia', 'PhotoController@storeCKEditorImages')->name('photos.storeCKEditorImages');
    Route::post('photos/parse-csv-import', 'PhotoController@parseCsvImport')->name('photos.parseCsvImport');
    Route::post('photos/process-csv-import', 'PhotoController@processCsvImport')->name('photos.processCsvImport');
    Route::resource('photos', 'PhotoController');

    Route::get('messenger', 'MessengerController@index')->name('messenger.index');
    Route::get('messenger/create', 'MessengerController@createTopic')->name('messenger.createTopic');
    Route::post('messenger', 'MessengerController@storeTopic')->name('messenger.storeTopic');
    Route::get('messenger/inbox', 'MessengerController@showInbox')->name('messenger.showInbox');
    Route::get('messenger/outbox', 'MessengerController@showOutbox')->name('messenger.showOutbox');
    Route::get('messenger/{topic}', 'MessengerController@showMessages')->name('messenger.showMessages');
    Route::delete('messenger/{topic}', 'MessengerController@destroyTopic')->name('messenger.destroyTopic');
    Route::post('messenger/{topic}/reply', 'MessengerController@replyToTopic')->name('messenger.reply');
    Route::get('messenger/{topic}/reply', 'MessengerController@showReply')->name('messenger.showReply');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth', '2fa']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
        Route::post('profile/two-factor', 'ChangePasswordController@toggleTwoFactor')->name('password.toggleTwoFactor');
    }
});
Route::group(['namespace' => 'Auth', 'middleware' => ['auth', '2fa']], function () {
    // Two Factor Authentication
    if (file_exists(app_path('Http/Controllers/Auth/TwoFactorController.php'))) {
        Route::get('two-factor', 'TwoFactorController@show')->name('twoFactor.show');
        Route::post('two-factor', 'TwoFactorController@check')->name('twoFactor.check');
        Route::get('two-factor/resend', 'TwoFactorController@resend')->name('twoFactor.resend');
    }
});
