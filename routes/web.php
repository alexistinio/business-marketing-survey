<?php

use App\Http\Controllers\GroupController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\StatisticsController;
use App\Http\Controllers\UserManagementController;
use App\Http\Livewire\Post\ViewAnswer;
use App\Http\Livewire\Post\Index;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/welcome', [HomeController::class, 'welcome'])->name('welcome');
Route::middleware(['auth', 'notification'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/subscription', [SubscriptionController::class, 'index'])->name('subscription');
    Route::get('/payment', [SubscriptionController::class, 'payment'])->name('payment');
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notification');
    Route::get('/claim_points', [HomeController::class, 'claim_points']);

    // Posts Route
    Route::group(['prefix' => 'post', 'as' => 'post.'], function () {
        Route::group(['middleware' => ['subscribed']], function () {
            Route::get('/', [PostController::class, 'index'])->name('index');
            Route::get('/create', [PostController::class, 'create'])->name('create');
            Route::get('/edit/{id}', [PostController::class, 'edit'])->name('edit');
        });

        Route::get('/answer/{id}', [PostController::class, 'answer'])->name('answer');
        Route::get('/answers/{id}', [ViewAnswer::class, 'index'])->name('view-answers');
        Route::get('/getGraph/{id}/{graph}', [ViewAnswer::class, 'getGraph']);
        

      
  
     
    });

    // Group Route
    Route::get('/group', [GroupController::class, 'index'])->name('group');
    Route::get('/group/{id}', [GroupController::class, 'view'])->name('group.view');

    // profile
    Route::get('profile/{id?}', [ProfileController::class, 'index'])->name('profile.index');

    Route::group(['prefix' => 'user-management', 'as' => 'user-management.'], function () {
        Route::get('/', [UserManagementController::class, 'index'])->name('index')->can('can_view_user_management');
        Route::get('/edit/{id}', [UserManagementController::class, 'edit'])->name('edit')->can('can_edit_user_management');
        Route::get('/create', [UserManagementController::class, 'create'])->name('create')->can('can_add_user_management');
        Route::get('/reset/{id}', [UserManagementController::class, 'reset_points'])->can('can_add_user_management');
    });


    Route::get('/message/{id?}', [MessageController::class, 'index'])->name('message');
    Route::get('/fetch-message', [MessageController::class, 'fetchMessage'])->name('fetch-message');
    Route::post('/send-message', [MessageController::class, 'sendMessage']);
    Route::post('/read-message', [MessageController::class, 'readMessage']);
});



require __DIR__ . '/auth.php';
