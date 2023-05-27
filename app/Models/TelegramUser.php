<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model as Eloquent;

class TelegramUser extends Eloquent
{
    public $incrementing  = false;
    public $timestamps = false;
    protected $table = "telegram_users";
    protected $primaryKey = "telegram_user_id";

    protected $fillable = [
        "telegram_user_id",
        "moodle_user_id",
        "wstoken"
    ];

    public static function isUserStored(int $user_id) : bool
    {
        return self::where("telegram_user_id",$user_id)->count() > 0 ? true : false;
    }

    // public static function getOrStoreUser(int $user_id) : int
    // {
    //     if(self::isUserStored($user_id)){
    //         return self::where("telegram_user_id",$user_id)->first();
    //     }else{

    //     }
    // }
}