<?php

namespace App\Http\Commands;

use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;

class StartCommand extends Command
{
    protected $name = 'start';
    protected $description = 'Начать работу';

    public function handle($arguments)
    {
        $keyboard = [
            ['Скидки'],
            ['Помощь'],
        ];

        // This will update the chat status to typing...
        $this->replyWithChatAction(['action' => Actions::TYPING]);

        $reply_markup = Telegram::replyKeyboardMarkup([
          	'keyboard' => $keyboard,
          	'resize_keyboard' => true,
          	'one_time_keyboard' => true
        ]);

        $this->replyWithMessage([
            'text' => 'Добро пожаловать в Onsells - место самых выгодных скидок!',
            'reply_markup' => $reply_markup
        ]);

        // Trigger another command dynamically from within this command
        // When you want to chain multiple commands within one or process the request further.
        // The method supports second parameter arguments which you can optionally pass, By default
        // it'll pass the same arguments that are received for this command originally.
        // $this->triggerCommand('subscribe');


    }

}
