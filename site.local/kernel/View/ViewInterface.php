<?php

namespace App\Kernel\View;

interface ViewInterface
{
    public function page(string $name);

    public function component(string $name);
}
