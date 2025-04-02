<?php
require_once "../etc/config.php";
require_once "../etc/flash_message.php";

const UPLOAD_DIR = "../images/";

function makeParagraphs($text) {
    $sentences = explode("\n", $text);
    $sentences = array_filter($sentences, function($s) {
        return strlen(trim($s)) > 0;
    });
    $html = "<p>". implode("</p><p>", $sentences) . "</p>";

    return $html;
}

try {
    //If storing story went wrong throw an error
    if($_SERVER["REQUEST_METHOD"] !=="POST") {
        throw new Exception("Invaild request method");
    }
    //check the class
    $validator = new StoryFormValidator($_POST, $_FILES);
    //input that the validate function into $vaild
    $valid = $validator->validate();

    //it is valid, meaning the information the user hs enter had reached the requirements, 
    if($valid) {
        // $data = $validator->data();
        //make the new story
        // $story =  new Story($data);
        // save it 
        // $story->save();
        
        // save the uploaded file to the server
        $img_file = new File($_FILES["img_url"]);
        $extension = $img_file->getExtension();
        $filename = "photo-". strtotime(date('Y-m-d H:i:s')) . '-' . uniqid() . '.' . $extension;
        $filepath = $img_file->move(UPLOAD_DIR, $filename);

        // save the form data to the database
        $story = new Story($validator->data());
        $story->article = makeParagraphs($story->article);
        $story->img_url = 'images/' . $filename;
        $story->save();

        // redirect the browser to the success page
        // redirect("view_story.php?id=" . $story->id);
        // redirect("story_tab.php?id=" . $story->id);



        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        //send a flash success message if done correctly
        $_SESSION["flash"] = [ 
            "message" => "Story has been created",
            "type" =>"success" 
        ];
        //then go back to the story_tab page see it the new story
        redirect("story_tab.php?id=" . $story->id);
    }
    else {
        //if there is a problem, show the errors made and send a flash error message
        $errors = $validator->errors();
        print_r ($errors);
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION["form-data"] = $_POST;
        $_SESSION["form-errors"] = $errors;
        $_SESSION["flash"] = [ 
            "message" => "Error creating a story",
            "type" =>"failed" 
        ];

        //once the errors are shown, it goes to the create page to fix the issue made
        redirect("story_create.php");
    }
}
catch(Exception $ex) {
    echo $ex->getMessage();
    exit();
}
?>