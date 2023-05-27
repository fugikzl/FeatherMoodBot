<?php

namespace App\Controllers;

use App\Models\TelegramUser;
use App\Telegram\GlobalTelegram;
use Exception;

class CourseController extends Controller
{
    public function pong()
    {
        echo "pong";
    }

    public function setUpdate()
    {
        $data = $this->request->entityBody;
        $moodle_user_id = $data["moodle_user_id"];

        $telegramUser = TelegramUser::where("moodle_user_id",$moodle_user_id)->first();
        if($telegramUser === null){
            throw new Exception("No user with provided moodle user id in database");
        }
        
        GlobalTelegram::sendUpdates($telegramUser->telegram_user_id, $data["update"]);
    }
}