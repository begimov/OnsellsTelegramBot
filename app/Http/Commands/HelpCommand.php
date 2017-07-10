<?php

namespace App\Http\Commands;

use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;

class HelpCommand extends Command
{
    protected $name = 'help';
    protected $description = 'Получить помощь по доступным командам';

    public function handle($arguments)
    {
        $this->replyWithMessage([
            'text' => 'Доступные команды:'
        ]);
        // This will prepare a list of available commands and send the user.
        // First, Get an array of all registered commands
        // They'll be in 'command-name' => 'Command Handler Class' format.
        $commands = $this->getTelegram()->getCommands();
        $response = '';
        foreach ($commands as $name => $command) {
            $response .= sprintf('/%s - %s' . PHP_EOL, $name, $command->getDescription());
        }
        // Reply with the commands list
        $this->replyWithMessage(['text' => $response]);
    }

}
