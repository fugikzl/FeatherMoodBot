<?php

use App\Controllers\CourseController;
use App\Telegram;

$router->post('/webhook', Telegram::class.'@boot');
$router->get('/ping', CourseController::class.'@pong');
$router->get('/', function(){
    echo "That's a bot";
});
$router->post('/set-update', CourseController::class.'@setUpdate');
