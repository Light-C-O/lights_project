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
    //find the id of the already existing author
    $author = Author::findById($id);
    //if there is no author to update, meaning no id found, throw an exception meassage
    if($author === null) {
        throw new Exception("Author not found");
    }
    //input the clas into $validator
    $validator = new AuthorFormValidator($_POST);
    //check if the input the user is has reach the requirements
    $valid = $validator->validate();
    //if it did
    if($valid) {
        //edit and input the changes with the already existing data
        $data = $validator->data();
        $author->first_name = $data["first_name"];
        $author->last_name = $data["last_name"];
        //save the changes
        $author->save();
    //if everything goes well, display a flash message and go back to the index.php (All Authors page) to see the changes
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        //send a flash success message if done correctly
        $_SESSION["flash"] = [ 
            "message" => "Author has been updated",
            "type" =>"success" 
        ];
    redirect("author_tab.php");
    }
    else {
        //if everything did not go well, it will go to the author_edit.php and user should settle the errors shown
        $errors = $validator->errors();
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION["form-data"] = $_POST;
        $_SESSION["form-errors"] = $errors;
        $_SESSION["flash"] = [ 
            "message" => "Failed update author",
            "type" =>"failed"
        ];
        redirect("author_edit.php?id=$id");
    }
} //exit once out of use
catch (Exception $ex) {
    echo $ex->getMessage();
    exit();
}
?>