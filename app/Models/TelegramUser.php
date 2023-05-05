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
}