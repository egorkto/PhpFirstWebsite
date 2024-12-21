<?php

namespace App\Kernel\View;

interface ViewInterface
{
    public function page(string $name, array $data = []);

    public function component(string $name, array $data = []);
}
