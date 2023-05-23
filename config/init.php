<?php

define("DEBUG", 1); // where 0 - production, or 1 is development
define("ROOT", dirname(__DIR__)); // will indicate the path to the root
define("WWW", ROOT . '/public'); #path to the public folder
define("APP", ROOT . '/app'); #the path to the application
define("CORE", ROOT . '/vendor/wfm'); #wfm core
define("CACHE", ROOT . '/temp/cache');
define("LOGS", ROOT . '/temp/logs');