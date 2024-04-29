<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/chat', [ChatController::class, 'showChat'])->name('chat')->middleware(['auth']);
Route::post('/send-message/{recipient}', [ChatController::class, 'sendMessage'])->middleware(['auth']);
Route::get('/get-messages/{recipient}', [ChatController::class, 'getMessages'])->middleware(['auth']);
Route::get('/fetch-messages', [ChatController::class, 'fetchMessages'])->middleware(['auth']);
Route::get('/mark-messages-expire', [ChatController::class, 'markMessagesExpire']);


require __DIR__ . '/auth.php';
