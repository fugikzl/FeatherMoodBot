<?php

namespace App;

use App\Models\TelegramUser;
use App\Models\UserSetting;
use GuzzleHttp\Client;
use App\Telegram\GlobalTelegram;
class Telegram
{
    private GlobalTelegram $telegram;
    private $chat_id;
    private ?UserSetting $userSetting;
    private ?TelegramUser $telegramUser;
    
    private array $functions = [
        'sendMessage',
        'registerToken',
        'checkValidity',
        'startUpdates',
        'getSettings'
    ];
    

    public function __construct()
    {
        $this->telegram = new GlobalTelegram(env("TELEGRAM_BOT_API_KEY"));
        $this->chat_id = $this->telegram->ChatID();
        $this->telegramUser = TelegramUser::where("telegram_user_id",$this->chat_id)->first();
        $this->userSetting = UserSetting::where("telegram_user_id",$this->chat_id)->first();
    }

    public function boot()
    {
        $chat_id  = $this->chat_id;
        $result = $this->telegram->getData();
        $text = $result['message']['text'];
        $sep = explode("::",$text);


        if(array_key_exists(1,$sep)){
            $f = $sep[0];
            if(method_exists($this,$f)){
                $this->$f($sep[1]);
            }else{
                $this->telegram->sendMessage([
                    "chat_id" => $chat_id,
                    'text' => "Wrong function name given."
                ]);     
            }
        }else{
            $this->telegram->sendMessage([
                "chat_id" => $chat_id,
                'text' => "Totally wrong input."
            ]);   
        }
    }

    public function registerToken(string $wstoken)
    {
        $client = new Client();
        try {
            $res = $client->get(env("CUSTOM_MOODLE_API")."/$wstoken"."/get-user-info");
        } catch (\Throwable $th) {
            $this->telegram->sendMessage([
                "chat_id" => $this->chat_id,
                "text" => "Wrong token registered."
            ]);
            return;
        }

        $userInfo = json_decode($res->getBody(),1);

        if($this->telegramUser){
            $this->telegram->sendMessage([
                "chat_id" => $this->chat_id,
                "text" => "Your token registered earlier."
            ]);
        }else{
            $telegramUser = TelegramUser::create([
                "telegram_user_id" => $this->chat_id,
                "moodle_user_id" => $userInfo["user_id"],
                "wstoken" => $wstoken
            ]);
    
            UserSetting::create([
                "telegram_user_id" => $this->chat_id
            ]);

            $this->telegram->sendMessage([
                "chat_id" => $this->chat_id,
                "text" => $userInfo["full_name"].", Your token registered."
            ]);
        }
    }

    private function checkValidity(string $param = null){
        if($this->telegramUser && $this->userSetting){
            if($param !== null){
                $this->sendMessage("valid");
            }
            return true;
        }else{
            $this->sendMessage("not valid");
            die();
        }
    }

    public function getSettings(string $param = null)
    {
        $this->checkValidity();
        $text = '';
        $fillables = $this->userSetting->toArray();
        foreach($fillables as $setting=>$value){
            $text = $text."\n$setting : $value";
        }

        $this->sendMessage($text);
    }

    public function startUpdates(string $param = null)
    {
        $client = new Client();
        if($this->telegramUser){
            $wstoken = $this->telegramUser->wstoken;
            $res = $client->post(env("CUSTOM_MOODLE_API")."/$wstoken"."/registerUpdate");
        }else{
            $this->sendMessage("MATHERFAKA YOU DONT REGISTERED.\nregisterToken::<YOUR-TOKEN-HERE>");
        }
    }

    public function sendMessage(string $message){
        $chat_id = $this->chat_id;
        $this->telegram->sendMessage([
            "chat_id" => $chat_id,
            "text" => $message
        ]);
    }

    
}