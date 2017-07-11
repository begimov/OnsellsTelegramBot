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
        $this->replyMsg(['Добро пожаловать в Onsells - место самых выгодных скидок!']);

        $promotion = Promotion::latest()->with('mediumImage')->first();

        $this->replyPhoto([
            "{$promotion->mediumImage->path}",
        ]);

        $this->replyMsg([
            "<b>{$promotion->promotionname}</b>",
            "{$promotion->promotiondesc} {$promotion->website}",
            "Получить скидку https://onsells.ru/promotions/{$promotion->id}"
        ]);

        $keyboard = [
            ['Следующая акция']
        ];

        $inlineKeyboard = [
            ['Посетить сайт']
        ];

        $this->replyWithMessage([
            'text' => 'Test Keyboards',
            'reply_markup' => json_encode([
                // 'inline_keyboard' => $inlineKeyboard,
              	'keyboard' => $keyboard,
              	'resize_keyboard' => true,
            ]),
        ]);

        // Trigger another command dynamically from within this command
        // When you want to chain multiple commands within one or process the request further.
        // The method supports second parameter arguments which you can optionally pass, By default
        // it'll pass the same arguments that are received for this command originally.
        // $this->triggerCommand('subscribe');
    }

    private function replyMsg($messages, $parseMode = 'HTML')
    {
        foreach ($messages as $message) {
            if ($message) {
                $this->replyWithChatAction(['action' => Actions::TYPING]);
                $this->replyWithMessage([
                    'text' => $message,
                    'parse_mode' => $parseMode,
                ]);
            }
        }
    }

    private function replyPhoto($imagePaths)
    {
        foreach ($imagePaths as $imagePath) {
            if ($imagePath) {
                $this->replyWithChatAction(['action' => Actions::TYPING]);
                $this->replyWithPhoto([
                    'photo' => "https://onsells.ru$imagePath",
                ]);
            }
        }
    }

}
