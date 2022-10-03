<?php

namespace App\Enums\Traits;

use Illuminate\Support\Arr;

trait EnumerableTrait
{
    public static function options()
    {
        return (new \ReflectionClass(Self::class))->getConstants();
    }

    public static function only($optionsOnly = [])
    {
        return Arr::only((new \ReflectionClass(Self::class))->getConstants(), $optionsOnly);
    }

    public static function except($optionsExcept = [])
    {
        return Arr::except((new \ReflectionClass(Self::class))->getConstants(), $optionsExcept);
    }

    public static function tryFrom($type)
    {
        $options = Self::options();

        return in_array($type, $options);
    }
}
