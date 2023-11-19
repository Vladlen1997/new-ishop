<?php

namespace appCore;
trait TSingleton
{
    private static ?self $instance = null;

    private function __construct()
    {

    }


}
