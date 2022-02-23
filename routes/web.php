<?php

use App\Http\Controllers\MailController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\C3POController;
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
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::resources(['c3po' => C3POController::class]);
Route::get('/sapfeed/telegram/{link}/{qtemensagens}/{grupo}', 'App\Http\Controllers\C3POController@sapBlogFeedToTelegram')->name('c3po.sapBlogFeedToTelegram');
Route::get('/count/telegram/{grupo}', 'App\Http\Controllers\C3POController@telegramUserCount')->name('c3po.telegramUserCount');
Route::get('/youtubefeed/telegram/{grupo}/{channelid}', 'App\Http\Controllers\C3POController@youtubeFeed')->name('c3po.youtubeFeed');
Route::get('/reportclicks/abapdojo', 'App\Http\Controllers\C3POController@reportCliquesAabapDojo')->name('c3po.reportCliquesAabapDojo');
Route::get('/reportclicks/leoabap', 'App\Http\Controllers\C3POController@reportCliquesLeoAbap')->name('c3po.reportCliquesLeoAbap');
Route::get('/send-email', [MailController::class, 'sendEmail']);


require __DIR__.'/auth.php';
