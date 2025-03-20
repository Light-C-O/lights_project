<?php
$dir = dirname(__DIR__);

require_once $dir . '/etc/global.php';

//my path inorder to display image and navigate
$import= "http://localhost/intProj/lights_project/My_project/";

//related to upload.php
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