<?php

use App\Http\Controllers\StaticController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\SmsAuthController;
use App\Http\Controllers\OAuthController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

Route::auth();

Route::get('/login-phone', [StaticController::class,'index']);
Route::get('/login-email', [StaticController::class,'index']);
Route::get('/register', [StaticController::class,'index']);
Route::get('/password-reset', [StaticController::class,'index']);
Route::get('/send-confirm', [StaticController::class,'index']);

Route::get('/logout', [LoginController::class,'logout']);
Route::get('/confirm-registration/{token}', [RegisterController::class,'confirmRegistration']);
Route::post('/confirm-user', [RegisterController::class,'confirmUser']);

//Route::get('/profile', 'UserController@profile');
//Route::post('/profile', 'UserController@editProfile');
//Route::post('/profile-delete', 'UserController@deleteProfile');

//Route::get('/fb-oauth', 'OAuthController@oAuthFb');
//Route::get('/fb-callback', 'OAuthController@fbCallback');

Route::get('/vk-oauth', [OAuthController::class,'oAuthVk']);
Route::get('/vk-callback', [OAuthController::class,'vkCallback']);

//Route::get('/google-callback', 'OAuthController@googleCallback');

Route::group(['middleware' => ['auth','admin'],'prefix' => 'admin'], function() {
//    Route::get('/', [AdminController::class,'index']);
//    Route::get('/users/{slug?}', [AdminController::class,'users']);
//    Route::post('/user', [AdminController::class,'editUser']);
//    Route::post('/delete-user', [AdminController::class,'deleteUser']);
//    Route::post('/delete-sms-login', [AdminController::class,'deleteSmsLogin']);
//
//    Route::get('/product_groups/{slug?}', [AdminController::class,'productGroups']);
//    Route::post('/product_group', [AdminController::class,'editProductGroup']);
//    Route::post('/delete-product_group', [AdminController::class,'deleteProductGroup']);
//
//    Route::get('/products/{slug?}', [AdminController::class,'products']);
//    Route::post('/product', [AdminController::class,'editProduct']);
//    Route::post('/delete-product', [AdminController::class,'deleteProduct']);
//
//    Route::get('/orders/{slug?}', [AdminController::class,'orders']);
//    Route::post('/order', [AdminController::class,'editOrder']);
//    Route::post('/get-product-price', [AdminController::class,'getProductPrice']);
//    Route::post('/delete-order', [AdminController::class,'deleteOrder']);
//
//    Route::get('/actions/{slug?}', [AdminController::class,'actions']);
//    Route::post('/action', [AdminController::class,'editAction']);
//    Route::post('/delete-action', [AdminController::class,'deleteAction']);
//
//    Route::get('/slides/{slug?}', [AdminController::class,'slides']);
//    Route::post('/slide', [AdminController::class,'editSlide']);
//    Route::post('/delete-slide', [AdminController::class,'deleteSlide']);
//
//    Route::get('/chapters/{slug?}', [AdminController::class,'chapters']);
//    Route::post('/chapter', [AdminController::class,'editChapter']);
//
//    Route::get('/sub-chapters/{slug?}', [AdminController::class,'subChapters']);
//    Route::post('/sub-chapter', [AdminController::class,'editSubChapter']);
//    Route::post('/delete-sub-chapter', [AdminController::class,'deleteSubChapter']);
//
//    Route::get('/stations/{slug?}', [AdminController::class,'stations']);
//    Route::post('/station', [AdminController::class,'editStation']);
//    Route::post('/delete-station', [AdminController::class,'deleteStation']);
//    
//    Route::get('/seo', [AdminController::class,'seo']);
//    Route::post('/seo', [AdminController::class,'editSeo']);
//
//    Route::get('/settings', [AdminController::class,'settings']);
//    Route::post('/settings', [AdminController::class,'editSettings']);
});

Route::get('/', [StaticController::class,'index']);