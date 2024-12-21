<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;
use App\Services\CategoryService;

class AdminController extends Controller
{
    public function index()
    {
        $service = new CategoryService($this->db());
        $catergories = $service->all();

        $this->view('admin/index', ['categories' => $catergories]);
    }
}
