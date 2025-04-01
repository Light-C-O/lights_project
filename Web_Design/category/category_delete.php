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
    //find the category
    $category = Category::findById($id);
    //if the category is empty, there is no category to delete, throw an exception
    if($category === null) {
        throw new Exception("Category not found");
    }
    //if category has been found and an id is there, delete the category requested
    $category->delete();

    //start session for the flash message
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    //send a flash success message if done correctly
    $_SESSION["flash"] = [ 
        "message" => "Category has been deleted",
        "type" =>"success" 
    ];
    //redirect to the browser to category_tab page to see the result
    redirect("category_tab.php");
}//exit once out of use
catch (Exception $ex) {
    echo $ex->getMessage();
    exit();
}
?>