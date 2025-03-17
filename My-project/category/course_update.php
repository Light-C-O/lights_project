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
    //find the id of the already existing course
    $course = Course::findById($id);
    //if there is no course to update, meaning no id found, throw an exception meassage
    if($course === null) {
        throw new Exception("Course not found");
    }
    //input the clas into $validator
    $validator = new CourseFormValidator($_POST);
    //check if the input the user is has reach the requirements
    $valid = $validator->validate();
    //if it did
    if($valid) {
        //edit and input the changes with the already existing data
        $data = $validator->data();
        $course->title = $data["title"];
        $course->description = $data["description"];
        $course->code = $data["code"];
        $course->department_id = $data["department_id"];
        //save the changes
        $course->save();
    //if everything goes well, display a flash message and go back to the index.php (All Courses page) to see the changes
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        //send a flash success message if done correctly
        $_SESSION["flash"] = [ 
            "message" => "Course has been updated",
            "type" =>"success" 
        ];
    redirect("index.php");
    }
    else {
        //if everything did not go well, it will go to the course_edit.php and user should settle the errors shown
        $errors = $validator->errors();
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION["form-data"] = $_POST;
        $_SESSION["form-errors"] = $errors;
        $_SESSION["flash"] = [ 
            "message" => "Failed update course",
            "type" =>"failed"
        ];
        redirect("course_edit.php?id=$id");
    }
} //exit once out of use
catch (Exception $ex) {
    echo $ex->getMessage();
    exit();
}
?>