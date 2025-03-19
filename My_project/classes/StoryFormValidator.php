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
        // if (isset($_POST["submit"])) {

        //     // Check image using getimagesize function and get size
        //     // if a valid number is got then uploaded file is an image
        //     if (isset($_FILES["img_url"])) {
        //         // directory name to store the uploaded image files
        //         // this should have sufficient read/write/execute permissions
        //         // if not already exists, please create it in the root of the
        //         // project folder
        //         $targetDir = "images/";
        //         $targetFile = $targetDir . basename($_FILES["img_url"]["name"]);
        //         $uploadOk = 1;
        //         $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
                
        //         // Validation here
        //     }
        // }

        // // Check for uploaded file formats and allow only 
        // // jpg, png, jpeg and gif
        // // If you want to allow more formats, declare it here
        // if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif"
        // ) {
        //     echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        //     $uploadOk = 0;
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