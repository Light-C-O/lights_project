<?php
require_once "../etc/config.php";

const UPLOAD_DIR = "../images/";

try{
    if($_SERVER["REQUEST_METHOD"] !=="POST") {
        throw new Exception("Invaild request method");
    }
    if(!array_key_exists("id", $_POST)) {
        throw new Exception("Invaild request parameters");
    }
    $id = $_POST["id"];
    //find the id of the already existing story
    $story = Story::findById($id);
    //if there is no story to update, meaning no id found, throw an exception meassage
    if($story === null) {
        throw new Exception("Story not found");
    }
    //input the clas into $validator
    $validator = new StoryFormValidator($_POST, $_FILES);
    //check if the input the user is has reach the requirements
    $fileRequired = false;
    $valid = $validator->validate($fileRequired);
    //if it did
    if($valid) {
        //edit and input the changes with the already existing data
        $data = $validator->data();
        $story->headline = $data["headline"];
        $story->short_headline = $data["short_headline"];
        $story->status = $data["status"];
        $story->article = $data["article"];

        //the img_url uploader
        if(is_uploaded_file($_FILES["img_url"]["tmp_name"])){
            $img_file = new File($_FILES["img_url"]);
            $extension = $img_file->getExtension();
            $filename = "photo-". strtotime(date('Y-m-d H:i:s')) . '-' . uniqid() . '.' . $extension;
            $filepath = $img_file->move(UPLOAD_DIR, $filename);

            //delete old image
            $oldImage = "../" . $story->img_url;


            if (file_exists($oldImage)) {
                unlink($oldImage);
            } 
            

            $story->img_url = 'images/' . $filename;

        }
        $story->img_description = $data["img_description"];
        $story->author_id = $data["author_id"];
        $story->category_id = $data["category_id"];
        $story->location_id = $data["location_id"];
        //save the changes
        $story->save();
    //if everything goes well, display a flash message and go back to the story_tab.php (All Stories page) to see the changes
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        //send a flash success message if done correctly
        $_SESSION["flash"] = [ 
            "message" => "Story has been updated",
            "type" =>"success" 
        ];
    redirect("story_tab.php");
    }
    else {
        //if everything did not go well, it will go to the story_edit.php and user should settle the errors shown
        $errors = $validator->errors();
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION["form-data"] = $_POST;
        $_SESSION["form-errors"] = $errors;
        $_SESSION["flash"] = [ 
            "message" => "Failed update story",
            "type" =>"failed"
        ];
        redirect("story_edit.php?id=$id");
    }
} //exit once out of use
catch (Exception $ex) {
    echo $ex->getMessage();
    exit();
}
?>