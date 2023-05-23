<?php


namespace wfm;


class Registry
{
    use TSingleton;

    protected static array $properties = [];

    public static function setProperties($name, $value)
    {
        self::$properties[$name] = $value;
    }

}

