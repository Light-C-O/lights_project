<?php
require_once "../etc/config.php";

try{
    //if not a POST request, throw an exception
    if($_SERVER["REQUEST_METHOD"] !=="POST") {
        throw new Exception("Invaild request method");
    }
    //if an id doesn't exist, throw an exception
    if(!array_key_exists("id", $_POST)) {
        throw new Exception("Invaild request parameters");
    }
    //needs an id
    $id = $_POST["id"];
    //find the course
    $course = Course::findById($id);
    //if the course is empty, there is no course to delete, throw an exception
    if($course === null) {
        throw new Exception("Course not found");
    }
    //if course has been found and an id is there, delete the course requested
    $course->delete();

    //start session for the flash message
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    //send a flash success message if done correctly
    $_SESSION["flash"] = [ 
        "message" => "Course has been deleted",
        "type" =>"success" 
    ];
    //redirect to the browser to index page to see the result
    redirect("index.php");
}//exit once out of use
catch (Exception $ex) {
    echo $ex->getMessage();
    exit();
}
?>