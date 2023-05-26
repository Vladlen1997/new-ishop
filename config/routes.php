<?php

use wfm\Router;

Router::add('^admin/?$', ['controller' => 'Main', 'action' => 'index', 'admin_prefix' => 'admin']);

Router::add('^admin/(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$', ['admin_prefix' => 'admin']);

Router::add('^$', ['controller' => 'main-controller', 'action' => 'index']);#first rule

Router::add('^(?P<controller>[a-z-]+)/(?P<action>[a-z-]+)/?$');
