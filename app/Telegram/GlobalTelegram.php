<?php
namespace App\Telegram;

use Telegram;
class GlobalTelegram extends Telegram
{
    public static function sendUpdates($chat_id, array $updates)
    {
        $telegram = new GlobalTelegram(env("TELEGRAM_BOT_API_KEY"));
        $text = "".$updates[0]["course_name"]."\n";

        foreach($updates as $update)
        {
            $old_grade = $update["old_grade"] == -1 ? "—" : $update["old_grade"]."%"; 
            $text = $text."\n\t".$update["module_name"]." ".$old_grade." --> ".$update["current_grade"]."%";
        }

        $telegram->sendMessage([
            "chat_id" => $chat_id,
            'text' => $text
        ]);   
    }
    
}