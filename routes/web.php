<?php

use App\Http\Controllers\PaymentGatewayController;
use Illuminate\Support\Facades\Route;

Route::get('/payment-gateway/verify/{gu_id}/{bank}', [PaymentGatewayController::class,'verify']);

Route::get("/user",[\App\Http\Controllers\UserController::class,"index"])->name("users")->middleware(["auth"]);
Route::group(["prefix"=>"user","middleware"=>"auth"],function (){
	Route::get("/create",[\App\Http\Controllers\UserController::class,"create"])->name("user.create");
	Route::post("/store",[\App\Http\Controllers\UserController::class,"store"])->name("user.store");
	Route::get("/{id}/edit",[\App\Http\Controllers\UserController::class,"update"])->name("user.update");
	Route::put("/{id}",[\App\Http\Controllers\UserController::class,"edit"])->name("user.edit");
	Route::get("/{id}",[\App\Http\Controllers\UserController::class,"show"])->name("user.show");
});

Route::get("/chart",[\App\Http\Controllers\ChartController::class,"index"])->name("charts");

Route::get("/faq",[\App\Http\Controllers\FaqController::class,"index"])->name("faqs");

Route::get("/subscribe",[\App\Http\Controllers\SubscribeController::class,"index"])->name("subscribes");

Route::get("/userSubscribe",[\App\Http\Controllers\UserSubscribeController::class,"index"])->name("usersubscribes");

Route::get("/menu",[\App\Http\Controllers\MenuController::class,"index"])->name("menus");

Route::get("/payment",[\App\Http\Controllers\PaymentController::class,"index"])->name("payments");

Route::get("/memberList",[\App\Http\Controllers\MemberListController::class,"index"])->name("memberlists");

Route::get("/notification",[\App\Http\Controllers\NotificationController::class,"index"])->name("notifications");

Route::get("/userNotification",[\App\Http\Controllers\UserNotificationController::class,"index"])->name("usernotifications");

Route::get("/userQuestion",[\App\Http\Controllers\UserQuestionController::class,"index"])->name("userquestions");

Route::get("/admin",[\App\Http\Controllers\AdminController::class,"index"])->name("admins");


// test
Route::get('/', function () {     return view('welcome'); });
