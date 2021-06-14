<?php

use App\Http\Controllers\PlaceController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\PlaceListController;
use App\Http\Controllers\FavListController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});
Route::middleware(['auth:sanctum', 'verified'])->group(function(){

    // 地図表示
    Route::get('/map', function () {
        return Inertia::render('Map');
    })->name('map');

    // 練習場所関係
    Route::resource('places', PlaceController::class);

    // お気に入り
    Route::post('places/{place}/favorite', [FavoriteController::class, 'store']);

    // ユーザー一覧
    Route::get('/users', [UsersController::class, 'index'])->name('users.index');

    // ユーザー詳細
    Route::get('/users/{user}', [UsersController::class, 'show'])->name('users.show');

    Route::get('/{user}/placeList', [PlaceListController::class, 'index'])->name('placeList.index');

    Route::get('/{user}/favList', [FavListController::class, 'index'])->name('favList.index');
});
