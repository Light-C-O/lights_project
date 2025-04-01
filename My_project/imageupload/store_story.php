<?php

require_once "./etc/config.php";

const UPLOAD_DIR = "images";

function makeParagraphs($text) {
    $sentences = explode("\n", $text);
    $sentences = array_filter($sentences, function($s) {
        return strlen(trim($s)) > 0;
    });
    $html = "<p>". implode("</p><p>", $sentences) . "</p>";

    return $html;
}

try {
    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        throw new Exception("Invalid request method");
    }
    $validator = new StoryFormValidator($_POST, $_FILES);
    $valid = $validator->validate();
    if ($valid) {
        // save the uploaded file to the server
        $img_file = new File($_FILES["img_url"]);
        $extension = $img_file->getExtension();
        $filename = "photo-". strtotime(date('Y-m-d H:i:s')) . '-' . uniqid() . '.' . $extension;
        $filepath = $img_file->move(UPLOAD_DIR, $filename);

        // save the form data to the database
        $story = new Story($validator->data());
        $story->article = makeParagraphs($story->article);
        $story->img_url = $filepath;
        $story->save();

        // redirect the browser to the success page
        redirect("view_story.php?id=" . $story->id);
    }
    else {
        $errors = $validator->errors();
        // redirect the browser back to the form
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION["form-data"] =  $_POST;
        $_SESSION["form-errors"] = $errors;
        redirect("create_story.php");
    }
}
catch (Exception $ex) {
    echo $ex->getMessage();
    exit();
}
?>