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
    //find the story
    $story = Story::findById($id);
    //if the story is empty, there is no story to delete, throw an exception
    if($story === null) {
        throw new Exception("Story not found");
    }
    //if story has been found and an id is there, delete the story requested
    $story->delete();

    //start session for the flash message
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    //send a flash success message if done correctly
    $_SESSION["flash"] = [ 
        "message" => "Story has been deleted",
        "type" =>"success" 
    ];
    //redirect to the browser to story_tab page to see the result
    redirect("story_tab.php");
}//exit once out of use
catch (Exception $ex) {
    echo $ex->getMessage();
    exit();
}
?>