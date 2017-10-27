<?php

spl_autoload_register(function ($class_name) {
    $class_name = str_replace(['\\', '/'], DIRECTORY_SEPARATOR, $class_name);
    $rootDir = __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR;

    include_once $rootDir . "{$class_name}.php";
});