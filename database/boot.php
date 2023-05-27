<?php
use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule();
$capsule->addConnection([
    "driver" => "sqlite",
    "database" => "database/feather.db",
]);

$capsule->setAsGlobal();
$capsule->bootEloquent();

try{
    $capsule->table("telegram_users")->get();
}catch(Throwable $th){
    require_once("./database/migrations/telegram_user.php");
}

try{
    $capsule->table("user_settings")->get();
}catch(Throwable $th){
    require_once("./database/migrations/user_setting.php");
}


