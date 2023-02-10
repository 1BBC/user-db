<?php

namespace App\Services\ImageOptimize;

interface ImageOptimizeContract
{
    public function optimize(string $path, string $savePath, int $width = null, int $height = null): void;
}
