<?php

namespace App\Enums;

class Enum
{
    /**
     * Constants cache.
     *
     * @var array
     */
    protected static $constCacheArray = [];

    public static function getConstants()
    {
        $calledClass = get_called_class();

        if (!array_key_exists($calledClass, static::$constCacheArray)) {
            $reflect = new \ReflectionClass($calledClass);
            static::$constCacheArray[$calledClass] = $reflect->getConstants();
        }

        return static::$constCacheArray[$calledClass];
    }
}
