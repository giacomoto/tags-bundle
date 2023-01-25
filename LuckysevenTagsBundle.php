<?php

namespace Luckyseven\Bundle\LuckysevenTagsBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class LuckysevenTagsBundle extends Bundle
{
    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}
