<?php
class StoryFormValidator extends FormValidator {
    public function __construct ($data=[]) {
        parent::__construct($data);
    }

    //The requirments to made
    public function validate() {
        //Table -- courses

        //Headline
        if(!$this->isPresent("headline")) {
            $this->errors["headline"] = "Please state the headline";
        }
        else if(!$this->maxLength("headline", 255)) {
            $this->errors['headline'] = "Headline must be no more than 255 characters long";
        }

        //Short headline
        if(!$this->isPresent("short_headline")) {
            $this->errors["short_headline"] = "Please state the short headline";
        }
        else if(!$this->maxLength("short_headline", 100)) {
            $this->errors['short_headline'] = "Short headline must be no more 100 characters long";
        }

        //Status
        if(!$this->isPresent("status")) {
            $this->errors["status"] = "Please pick the status";
        }
        //Article
        if(!$this->isPresent("article")) {
            $this->errors["article"] = "Please state the article";
        }

        //Image upload

        // if(!$this->isPresent("img_url")) {
        //     $this->errors["img_url"] = "Please upload img format [images/name]";
        // }

        
        //$target_dir = "images/";
        //$target_file = $target_dir . basename($_FILES["img_url"]["name"]);
        //$uploadOk = 1;
        //$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image#

        // if(isset($_POST["submit"])) {
        // $check = getimagesize($_FILES["img_url"]["tmp_name"]);
        // if($check !== false) {
        //     echo "File is an image - " . $check["mime"] . ".";
        //     $uploadOk = 1;
        // } else {
        //     echo "File is not an image.";
        //     $uploadOk = 0;
        // }
        // }

        // Check if file already exists#

        // if (file_exists($target_file)) {
        // echo "Sorry, file already exists.";
        // $uploadOk = 0;
        // }

        // Check file size#
        // if ($_FILES["fileToUpload"]["size"] > 500000) {
        // echo "Sorry, your file is too large.";
        // $uploadOk = 0;
        // }

        // Allow certain file formats#

        // if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        // && $imageFileType != "gif" ) {
        // echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        // $uploadOk = 0;
        // }

        // Check if $uploadOk is set to 0 by an error#

        // if ($uploadOk == 0) {
        // echo "Sorry, your file was not uploaded.";

        // if everything is ok, try to upload file#

        // } else {
        // if (move_uploaded_file($_FILES["img_url"]["tmp_name"], $target_file)) {
        //     echo "The file ". htmlspecialchars( basename( $_FILES["img_url"]["name"])). " has been uploaded.";
        // } else {
        //     echo "Sorry, there was an error uploading your file.";
        // }
        // }

        //Image description
        if(!$this->isPresent("img_description")) {
            $this->errors["img_description"] = "Please description the image";
        }

        //Author
        if(!$this->isPresent("author_id")) {
            $this->errors["author_id"] = "Please state the author";
        }
        
        //Category
        if(!$this->isPresent("category_id")) {
            $this->errors["category_id"] = "Please state the category";
        }
        
        //Location
        if(!$this->isPresent("location_id")) {
            $this->errors["location_id"] = "Please state the location";
        }

        //Created
        if(!$this->isPresent("created_at")) {
            $this->errors["created_at"] = "Please state the created date";
        }
        
        //Updated
        if(!$this->isPresent("updated_at")) {
            $this->errors["updated_at"] = "Please state the updated date";
        }

        return count($this->errors) === 0;
    }
}
?>