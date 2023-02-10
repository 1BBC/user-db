<?php

namespace App\Services\ImageOptimize;

use Nette\Utils\Image;

class FakeImageOptimizeService implements ImageOptimizeContract
{
    public function optimize(string $path, string $savePath, int $width = null, int $height = null): void
    {
        $image = Image::fromFile($path);

        if ($width && $height) {
            $image->resize($width, $height);
        }

        $image->save($savePath);
    }
}
