<?php

namespace App\Http\Commands;

use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;
use App\Models\Promotions\Promotion;

class StartCommand extends Command
{
    protected $name = 'start';
    protected $description = 'Начать работу';

    public function handle($arguments)
    {
        // This will update the chat status to typing...
        $this->replyWithChatAction(['action' => Actions::TYPING]);

        // $this->reply('Добро пожаловать в Onsells - место самых выгодных скидок!');

        $this->replyWithMessage([
            'text' => 'Добро пожаловать в Onsells - место самых выгодных скидок!',
        ]);

        // $promotion = Promotion::latest()->first();

        // $this->reply($promotion->promotionname);

        // Trigger another command dynamically from within this command
        // When you want to chain multiple commands within one or process the request further.
        // The method supports second parameter arguments which you can optionally pass, By default
        // it'll pass the same arguments that are received for this command originally.
        // $this->triggerCommand('subscribe');
    }

    private function reply($message)
    {
      $this->replyWithMessage([
          'text' => $message,
      ]);
    }

}
