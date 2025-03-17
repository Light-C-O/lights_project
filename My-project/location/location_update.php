<?php
require_once "../etc/config.php";

try{
    if($_SERVER["REQUEST_METHOD"] !=="POST") {
        throw new Exception("Invaild request method");
    }
    if(!array_key_exists("id", $_POST)) {
        throw new Exception("Invaild request parameters");
    }
    $id = $_POST["id"];
    //find the id of the already existing location
    $location = Location::findById($id);
    //if there is no location to update, meaning no id found, throw an exception meassage
    if($location === null) {
        throw new Exception("Location not found");
    }
    //input the clas into $validator
    $validator = new LocationFormValidator($_POST);
    //check if the input the user is has reach the requirements
    $valid = $validator->validate();
    //if it did
    if($valid) {
        //edit and input the changes with the already existing data
        $data = $validator->data();
        $location->name = $data["name"];
        //save the changes
        $location->save();
    //if everything goes well, display a flash message and go back to the index.php (All Locations page) to see the changes
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        //send a flash success message if done correctly
        $_SESSION["flash"] = [ 
            "message" => "Location has been updated",
            "type" =>"success" 
        ];
    redirect("location_table.php");
    }
    else {
        //if everything did not go well, it will go to the location_edit.php and user should settle the errors shown
        $errors = $validator->errors();
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION["form-data"] = $_POST;
        $_SESSION["form-errors"] = $errors;
        $_SESSION["flash"] = [ 
            "message" => "Failed update location",
            "type" =>"failed"
        ];
        redirect("location_edit.php?id=$id");
    }
} //exit once out of use
catch (Exception $ex) {
    echo $ex->getMessage();
    exit();
}
?>