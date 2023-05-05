<?php

use App\Controllers\CourseController;
use App\Telegram;

$router->post('/webhook', Telegram::class.'@boot');
$router->post('/ping', CourseController::class.'@pong');
