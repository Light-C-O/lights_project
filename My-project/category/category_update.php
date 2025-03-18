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
    //find the id of the already existing category
    $category = Category::findById($id);
    //if there is no category to update, meaning no id found, throw an exception meassage
    if($category === null) {
        throw new Exception("Category not found");
    }
    //input the clas into $validator
    $validator = new CategoryFormValidator($_POST);
    //check if the input the user is has reach the requirements
    $valid = $validator->validate();
    //if it did
    if($valid) {
        //edit and input the changes with the already existing data
        $data = $validator->data();
        $category->name = $data["name"];
        //save the changes
        $category->save();
    //if everything goes well, display a flash message and go back to the category_tab.php (All Categories page) to see the changes
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        //send a flash success message if done correctly
        $_SESSION["flash"] = [ 
            "message" => "Category has been updated",
            "type" =>"success" 
        ];
    redirect("category_tab.php");
    }
    else {
        //if everything did not go well, it will go to the category_edit.php and user should settle the errors shown
        $errors = $validator->errors();
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION["form-data"] = $_POST;
        $_SESSION["form-errors"] = $errors;
        $_SESSION["flash"] = [ 
            "message" => "Failed update category",
            "type" =>"failed"
        ];
        redirect("category_edit.php?id=$id");
    }
} //exit once out of use
catch (Exception $ex) {
    echo $ex->getMessage();
    exit();
}
?>