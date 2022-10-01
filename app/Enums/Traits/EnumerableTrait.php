<?php

namespace App\Enums\Traits;

trait EnumerableTrait
{
    public static function options()
    {
        return (new \ReflectionClass(Self::class))->getConstants();
    }

    public static function tryFrom($type)
    {
        $options = Self::options();

        return in_array($type, $options);
    }
}
