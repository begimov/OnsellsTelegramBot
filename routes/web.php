<?php

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
    // $response = Telegram::setWebhook([
    //     'url' => 'https://telegrambot.onsells.ru/' . env('TELEGRAM_WEBHOOK_TOKEN') . '/webhook'
    // ]);
    // dd($response);
    // $response = Telegram::getMe();
    //
    // $botId = $response->getId();
    // $firstName = $response->getFirstName();
    // $username = $response->getUsername();
    //
    // var_dump($response, $botId, $firstName, $username);
    return view('welcome');
});

Route::post('/' . env('TELEGRAM_WEBHOOK_TOKEN') . '/webhook', function() {
    $update = Telegram::commandsHandler(true);
    return 'ok';
});
