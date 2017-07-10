<?php

namespace App\Http\Commands;

use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;

class HelpCommand extends Command
{
    protected $name = 'help';
    protected $description = 'Get some help';

    public function handle($arguments)
    {
        $this->replyWithMessage([
            'text' => 'Доступные команды:'
        ]);
    }

}
