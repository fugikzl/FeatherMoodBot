<?php
use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule();
$capsule->addConnection([
    "driver" => "sqlite",
    "database" => "database/feather.db",
]);
$capsule->setAsGlobal();
$capsule->bootEloquent();