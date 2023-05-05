<?php
require_once("./database/boot.php");

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

Capsule::schema()->create('telegram_users', function (Blueprint $table) {
    $table->unsignedBigInteger("telegram_user_id")->primary();
    $table->unsignedBigInteger("moodle_user_id");
    $table->string('wstoken');
});
