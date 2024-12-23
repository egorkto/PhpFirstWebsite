<?php

namespace App\Kernel\Upload;

interface UploadedFileInterface
{
    public function move(string $path, ?string $filename = null): string|false;

    public function getExtention(): string;

    public function hasErrors(): bool;
}
