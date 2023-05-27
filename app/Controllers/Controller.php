<?php

namespace App\Controllers;

use App\Request;

class Controller
{
    public Request $request;

    public function __construct()
    {
        $this->request = new Request();
    }
}