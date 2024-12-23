<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;
use App\Services\MovieService;

class HomeController extends Controller
{
    public function index()
    {
        $moviesService = new MovieService($this->db());
        $this->view('home', [
            'movies' => $moviesService->new(),
        ]);
    }
}
