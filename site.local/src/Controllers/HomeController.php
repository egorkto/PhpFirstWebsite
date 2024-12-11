<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $this->view('home');
    }
}
