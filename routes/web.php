<?php

use App\Http\Controllers\Client\CategoryController;
use App\Http\Controllers\Client\StoreController;
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

Route::domain('{store}.localhost')->group(function () {
    Route::group(['prefix' => 'admin'], function () {
        Route::get('dashboard', [StoreController::class, 'index']);
        Route::resource('categories', CategoryController::class);
    });
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::group(['middleware' => 'auth', 'prefix' => 'my'], function () {
    Route::get('/stores', [StoreController::class, 'index']);
});

require __DIR__ . '/auth.php';
