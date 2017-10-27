<?php

defined('ROOT_DIR') or
define('ROOT_DIR', __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR. '..' . DIRECTORY_SEPARATOR);

require_once ROOT_DIR . 'base.php';

use src\CINF\Generator\Entrance;

$command = array_shift($argv);
$name = array_shift($argv);

$entrance = new Entrance($name);

$entrance->generate();
