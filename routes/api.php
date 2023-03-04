<?php

use App\Http\Controllers\FaqController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MemberListController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PaymentGatewayController;
use App\Http\Controllers\UserMemberListController;
use App\Http\Controllers\UserNotificationController;
use App\Http\Controllers\UserQuestionController;
use App\Http\Controllers\UserTokenController;
use Illuminate\Support\Facades\Route;


Route::get('/home/data', [HomeController::class,'index']);


Route::controller(AuthController::class)->group(function(){
    Route::group(["prefix"=>"auth"],function(){
        Route::post('/login', 'login');
        Route::get('/logout', 'logout');
        Route::post('/resend-password', 'resendPassword');
    });
});


Route::group(["prefix"=>"user"],function(){
    Route::controller(UserController::class)->group(function(){
        Route::post('/register', 'register');
        Route::post('/confirm-register', 'confirmRegister');
        Route::group(["middleware"=>"auth:api"],function(){
            Route::put('/edit', 'edit');
            Route::put('/change-password', 'changePassword');
            Route::put('/change-password', 'changePassword');
        });
    });

    Route::group(["middleware"=>"auth:api"],function(){
        Route::controller(UserMemberListController::class)->group(function(){
            Route::group(["prefix"=>"member-lists"],function(){
                Route::get('/', 'index');
                Route::post('/create', 'create');
                Route::post('/delete', 'delete');
            });
        });

        Route::middleware(['auth:api'])->post('/token/create', [UserTokenController::class,'create']);
    });
});

Route::get('/faqs', [FaqController::class,'index']);

Route::group(["middleware"=>"auth:api"],function(){
    Route::get('/request-pay', [PaymentGatewayController::class,'requestPay']);

    Route::post('/question', [UserQuestionController::class,'store']);
    Route::post('/notifications/push', [NotificationController::class,'push']);


    Route::controller(UserNotificationController::class)->group(function(){
        Route::group(["prefix"=>"notifications"],function(){
            Route::get('/', 'index');
            Route::put('/seen/{id}', 'seen');
        });
    });

    Route::get('/member-lists', [MemberListController::class, 'index']);

});

Route::post('/alertNotification', [NotificationController::class,'alertNotification']);


