<?php

namespace App;

use Telegram as GlobalTelegram;

class Telegram
{
    private GlobalTelegram $telegram;

    public function __construct()
    {
        $this->telegram = new GlobalTelegram(env("TELEGRAM_BOT_API_KEY"));
    }

    public function boot()
    {
        $chat_id = $this->telegram->ChatID();
        $content = array('chat_id' => $chat_id, 'text' => 'Test');
        $this->telegram->sendMessage($content);
    }
}