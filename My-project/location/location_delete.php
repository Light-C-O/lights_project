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
    //find the location
    $location = Location::findById($id);
    //if the location is empty, there is no location to delete, throw an exception
    if($location === null) {
        throw new Exception("Location not found");
    }
    //if location has been found and an id is there, delete the location requested
    $location->delete();

    //start session for the flash message
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    //send a flash success message if done correctly
    $_SESSION["flash"] = [ 
        "message" => "Location has been deleted",
        "type" =>"success" 
    ];
    //redirect to the browser to location_table page to see the result
    redirect("location_table.php");
}//exit once out of use
catch (Exception $ex) {
    echo $ex->getMessage();
    exit();
}
?>