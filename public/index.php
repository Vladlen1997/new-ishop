<?php

if (PHP_MAJOR_VERSION < 8) {
    die('required php version >= 8');
}

require_once dirname(__DIR__) . '/config/init.php';

new \wfm\App();
echo \wfm\App::$app->getProperties('pagination');
\wfm\App::$app->setProperties('test', 'TEST');
var_dump(\wfm\App::$app->getProperty());



