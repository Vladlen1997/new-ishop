<?php


namespace wfm;


class Registry
{
    use TSingleton;

    protected static array $properties = [];

    public function setProperties($name, $value)
    {
        self::$properties[$name] = $value;
    }

    public function getProperties($name)
    {
        return self::$properties[$name] ?? null;
    }

}

