<?php
$dir = dirname(__DIR__);

require_once $dir . '/etc/global.php';

//my path inorder to display image and navigate
$import= "http://localhost/lights_project/Web_Design/";
$js = "http://localhost/lights_project/Web_Design/etc/";
//related to upload.php
$mainpath= "C:\\xampp\htdocs\lights_project\Web_Design\\";

spl_autoload_register(function ($class) {
    global $dir;

    $class_path = str_replace('\\', '/', $class);

    $file = $dir . '/classes/' . $class_path . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});
?>