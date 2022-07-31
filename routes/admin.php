<?php

use Illuminate\Support\Facades\Route;

Route::get("login", function () {
    return view("admin.login");
});

Route::post("login", [\App\Http\Controllers\Admin\AuthController::class, "login"])->name("login");
Route::group(["middleware" => ['auth:web']], function () {

    Route::get("logout", [\App\Http\Controllers\Admin\AuthController::class, "logout"])->name("logout");
    Route::get("/", [\App\Http\Controllers\Admin\HomeController::class, "index"])->name("home");
    
    Route::get("users/search",[\App\Http\Controllers\Admin\UserController::class,"search"]);
    Route::resource("users",\App\Http\Controllers\Admin\UserController::class);
    Route::put("user/{id}/change-active",[\App\Http\Controllers\Admin\UserController::class,"changeActive"]);


    Route::resource("charts",\App\Http\Controllers\Admin\ChartController::class);
    Route::put("chart/{id}/change-just-special-users",[\App\Http\Controllers\Admin\ChartController::class,"changeJustSpecialUsers"]);

    Route::resource("faqs",\App\Http\Controllers\Admin\FaqController::class);

    Route::resource("subscribes",\App\Http\Controllers\Admin\SubscribeController::class);

    Route::resource("userSubscribes",\App\Http\Controllers\Admin\UserSubscribeController::class);

    Route::resource("menus",\App\Http\Controllers\Admin\MenuController::class);
    Route::put("menu/{id}/change-just-special-users",[\App\Http\Controllers\Admin\MenuController::class,"changeJustSpecialUsers"]);

    Route::resource("payments",\App\Http\Controllers\Admin\PaymentController::class);

    Route::resource("memberLists",\App\Http\Controllers\Admin\MemberListController::class);
    Route::put("memberLists/{id}/change-special-users",[\App\Http\Controllers\Admin\MemberListController::class,"changeSpecialUsers"]);
    Route::get("memberLists/{id}/users",[\App\Http\Controllers\Admin\MemberListController::class,"users"]);
    Route::delete("memberLists/{id}/users/{user}",[\App\Http\Controllers\Admin\MemberListController::class,"destroyUser"]);
    Route::post("memberLists/{id}/users",[\App\Http\Controllers\Admin\MemberListController::class,"createUser"])->name("memberList.users.create");

    Route::resource("notifications",\App\Http\Controllers\Admin\NotificationController::class);

    Route::resource("userNotifications",\App\Http\Controllers\Admin\UserNotificationController::class);

    Route::resource("userQuestions",\App\Http\Controllers\Admin\UserQuestionController::class);
    Route::post("userQuestions/answer",[\App\Http\Controllers\Admin\UserQuestionController::class,"answer"])->name('userQuestions.answer');

    Route::resource("admins",\App\Http\Controllers\Admin\AdminController::class);
    Route::get("profile", [\App\Http\Controllers\Admin\AdminController::class, "profile"])->name("admin.profile");
    Route::get("change-password", [\App\Http\Controllers\Admin\AdminController::class, "changePassword"])->name("admin.changePassword");
    Route::put("updateProfile", [\App\Http\Controllers\Admin\AdminController::class, "updateProfile"])->name("admin.updateProfile");
    Route::put("updatePassword", [\App\Http\Controllers\Admin\AdminController::class, "updatePassword"])->name("admin.updatePassword");
    Route::put("admin/{id}/change-active",[\App\Http\Controllers\Admin\AdminController::class,"changeActive"]);
});