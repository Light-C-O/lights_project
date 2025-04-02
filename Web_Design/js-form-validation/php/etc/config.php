<?php

$dir = dirname(__DIR__);

spl_autoload_register(function ($class) {
    global $dir;

    $class_path = str_replace('\\', '/', $class);

    $file = $dir . '/classes/' . $class_path . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});