<?php
class StoryFormValidator extends FormValidator {
    public function __construct ($data=[], $files=[]) {
        parent::__construct($data, $files);
    }

    //The requirments to made
    public function validate($fileRequired = true) {
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
        // if(!$this->isPresent("img_url", ("/^images\/$/") )) {
        //     $this->errors["img_url"] = "Please state the image Format: [images/{image-name.type}]";
        // }
        $maxFileSize = 1 * 1024 * 1024; // 1 MB
        $allowedTypes = ['image/jpg', 'image/JPG', 'image/jpeg', 'image/JEEG','image/png', 'image/PNG', 'image/gif', 'image/GIF'];

        if($fileRequired){
            if (!$this->hasFile("img_url")) {
                $this->errors["img_url"] = "Please choose an image";
            }
        }

        if ($this->hasFile("img_url")) {
            if (!$this->hasFileType("img_url", $allowedTypes)) {
                $this->errors["img_url"] = "Please choose a valid image type [jpg, JPG, jpeg, JPEG, png, PNG, gif, GIF]";
            }
            else if (!$this->hasFileSize("img_url", $maxFileSize)) {
                $this->errors["img_url"] = "Please choose an image with a size less than 1 MB";
            }
        }

        

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