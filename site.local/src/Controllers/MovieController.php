<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;

class MovieController extends Controller
{
    public function index()
    {
        $this->view('movies');
    }

    public function add()
    {
        $this->view('admin/movies/add');
    }

    public function store()
    {

        dd('store');
    }
}
