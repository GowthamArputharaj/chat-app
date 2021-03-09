<?php

use App\Events\BroadcastMessage;
use App\Events\NewMessage;
use App\Http\Controllers\MessagesController;
use App\Models\Messages;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('fire-event', function () {
    // $a = broadcast(new BroadcastMessage(4));
    $message = Messages::find(31);
    $a = broadcast(new NewMessage($message));
    dump($a);
    return 'fired';
});

Route::post('post-message', [MessagesController::class, 'store']);
Route::get('all-messages', [MessagesController::class, 'allMessages']);
Route::get('all-messages/{user_id}', [MessagesController::class, 'allPrivateMessages']);

