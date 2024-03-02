<?php

use App\Http\Controllers\PostPanelController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::redirect('/', '/posts');

Route::middleware(['auth'])->group(function () {
    Route::resource('posts', PostPanelController::class)->middleware('is_admin');
});

require __DIR__ . '/auth.php';
