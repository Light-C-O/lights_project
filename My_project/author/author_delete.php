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
    //find the author
    $author = Author::findById($id);
    //if the author is empty, there is no author to delete, throw an exception
    if($author === null) {
        throw new Exception("Author not found");
    }
    //if author has been found and an id is there, delete the author requested
    $author->delete();

    //start session for the flash message
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    //send a flash success message if done correctly
    $_SESSION["flash"] = [ 
        "message" => "Author has been deleted",
        "type" =>"success" 
    ];
    //redirect to the browser to index page to see the result
    redirect("author_tab.php");
}//exit once out of use
catch (Exception $ex) {
    echo $ex->getMessage();
    exit();
}
?>