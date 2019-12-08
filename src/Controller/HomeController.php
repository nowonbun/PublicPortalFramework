<?php

namespace App\Controller;

class HomeController extends AppController
{
    public function index(...$path)
    {
        $this->set('data', "hello world");
    }
}
