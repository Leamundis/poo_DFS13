<?php
require_once('vendor/autoload.php');
$GLOBALS['config'] = require('./config.php');
use Helper\Router as Router;


$router = new Router;
$router->route();

