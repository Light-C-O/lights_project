<?php
$dir = dirname(__DIR__);

require_once $dir . '/etc/global.php';

$import= "http://localhost/intProj/lights_project/My_project/";
$mainpath= "C:\\xampp\htdocs\intProj\lights_project\My_project\\";

spl_autoload_register(function ($class) {
    global $dir;

    $class_path = str_replace('\\', '/', $class);

    $file = $dir . '/classes/' . $class_path . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});
?>