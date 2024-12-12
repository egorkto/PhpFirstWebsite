<?php

namespace App\Kernel\Controller;

use App\Kernel\Http\Request;
use App\Kernel\View\View;

abstract class Controller
{
    private View $view;

    private Request $request;

    public function view(string $name)
    {
        $this->view->page($name);
    }

    public function setView(View $view)
    {
        $this->view = $view;
    }

    public function getRequest(): Request
    {
        return $this->request;
    }

    public function setRequest(Request $request)
    {
        $this->request = $request;
    }
}
