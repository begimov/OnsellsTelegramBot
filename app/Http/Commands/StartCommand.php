<?php

namespace App\Http\Commands;

use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;

class StartCommand extends Command
{
    protected $name = 'start';
    protected $description = 'Command to begin with';

    public function handle($arguments)
    {
        $this->replyWithMessage([
            'text' => 'Добро пожаловать в Onsells - место самых выгодных скидок!'
        ]);
        // This will update the chat status to typing...
        // $this->replyWithChatAction(['action' => Actions::TYPING]);

        // $response = array_reduce($commands, function($acc, $item) {
        //     return $acc .= sprintf('/%s - %s' . PHP_EOL, $item->getDescription());
        // }, '');

        // Trigger another command dynamically from within this command
        // When you want to chain multiple commands within one or process the request further.
        // The method supports second parameter arguments which you can optionally pass, By default
        // it'll pass the same arguments that are received for this command originally.
        // $this->triggerCommand('subscribe');
    }

}
