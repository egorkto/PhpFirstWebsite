<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;
use App\Services\CategoryService;
use App\Services\MovieService;

class AdminController extends Controller
{
    public function index()
    {
        $categoryService = new CategoryService($this->db());
        $catergories = $categoryService->all();
        $moviesService = new MovieService($this->db());
        $this->view('admin/index', [
            'categories' => $catergories,
            'movies' => $moviesService->all(),
        ]);
    }
}
