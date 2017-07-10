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

use App\Models\Promotions\Promotion;

Route::get('/', function () {
    if (App::environment('local')) {
        $promo = Promotion::latest()->with('mediumImage')->first();
        dd($promo->mediumImage->path);
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
        // return view('welcome');
    } else {
        return redirect()->away('https://onsells.ru');
    }
});

Route::post('/' . env('TELEGRAM_WEBHOOK_TOKEN') . '/webhook', function() {
    $update = Telegram::commandsHandler(true);
    return response()->json(["status" => "success"]);
});
