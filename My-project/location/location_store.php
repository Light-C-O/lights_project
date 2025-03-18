<?php
require_once "../etc/config.php";
require_once "../etc/flash_message.php";

try {
    //If storing location went wrong throw an error
    if($_SERVER["REQUEST_METHOD"] !=="POST") {
        throw new Exception("Invaild request method");
    }
    //check the class
    $validator = new LocationFormValidator($_POST);
    //input that the validate function into $vaild
    $valid = $validator->validate();

    //it is valid, meaning the information the user hs enter had reached the requirements, 
    if($valid) {
        $data = $validator->data();
        //make the new location
        $location =  new Location($data);
        // save it 
        $location->save();
        
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        //send a flash success message if done correctly
        $_SESSION["flash"] = [ 
            "message" => "Location has been created",
            "type" =>"success" 
        ];
        //then go back to the location_tab page see it the new location
        redirect("location_tab.php");
    }
    else {
        //if there is a problem, show the errors made and send a flash error message
        $errors = $validator->errors();
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION["form-data"] = $_POST;
        $_SESSION["form-errors"] = $errors;
        $_SESSION["flash"] = [ 
            "message" => "Error creating a location",
            "type" =>"failed" 
        ];

        //once the errors are shown, it goes to the create page to fix the issue made
        redirect("location_create.php");
    }
}
catch(Exception $ex) {
    echo $ex->getMessage();
    exit();
}
?>