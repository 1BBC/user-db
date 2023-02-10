<?php

namespace App\Services\ImageOptimize;

use function Tinify\fromFile;
use function Tinify\setKey;

class TinyPngImageOptimizeService implements ImageOptimizeContract
{
    public function __construct()
    {
        setKey(config('services.tinypng.api_key'));
    }

    public function optimize(string $path, string $savePath, int $width = null, int $height = null): void
    {
        $source = fromFile($path);

        if (empty($width) || empty($height)) {
            $source->toFile($savePath);
            return;
        }

        $source->toFile($path);

        $resized = $source->resize([
            'method' => 'thumb',
            'width' => $width,
            'height' => $height
        ]);

        $resized->toFile($savePath);
    }
}
