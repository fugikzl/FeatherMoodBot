<?php
require_once("./database/boot.php");

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

Capsule::schema()->create('user_settings', function (Blueprint $table) {
    $table->unsignedBigInteger("telegram_user_id")->primary();
    $table->boolean("update_tracking")->default(false);
    $table->boolean("deadline_tracking")->default(false);
    $table->boolean("is_premium_user")->default(false);
});
