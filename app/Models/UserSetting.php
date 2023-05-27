<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSetting extends Model
{
    protected $fillable = [
        'telegram_user_id',
        'update_tracking',
        'deadline_tracking',
        'is_premium_user'
    ];
    
    public $timestamps = false;
    public $incrementing  = false;
    protected $table = "user_settings";
    protected $primaryKey = "telegram_user_id";
}