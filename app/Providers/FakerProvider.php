<?php

namespace App\Providers;

use Faker\Provider\Base as BaseProvider;
use Nette\Utils\Image;

class FakerProvider extends BaseProvider
{
    /**
     * @param string $dir directory to save
     * @param int $width img width
     * @param int $height img height
     * @param string $type img type
     * @return string filename.jpg
     * @throws \Nette\Utils\ImageException
     */
    public function blankImage(string $dir, int $width = 70, int $height = 70, string $type = 'jpg'): string
    {
        $color = fn() => $this->generator->numberBetween(0,255);
        $rgb = Image::rgb(
            $color(),
            $color(),
            $color()
        );
        $file = uniqid().'.'.$type;
        $path = str($dir)->finish('/').$file;

        Image::fromBlank($width, $height, $rgb)->save($path);

        return $file;
    }
}
