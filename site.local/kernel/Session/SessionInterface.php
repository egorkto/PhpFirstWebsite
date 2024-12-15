<?php

namespace App\Kernel\Session;

interface SessionInterface
{
    public function set(string $key, $value);

    public function get(string $key, $default = null);

    public function getFlash(string $key, $default = null);

    public function has(string $key);

    public function remove(string $key);

    public function destroy();
}
