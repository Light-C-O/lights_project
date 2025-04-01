<?php
class StoryFormValidator extends FormValidator {
    public function __construct($data=[], $files=[]) {
        parent::__construct($data, $files);
    }

    public function validate() {
        if (!$this->isPresent("headline")) {
            $this->errors["headline"] = "Please enter a headline";
        }
        else if (!$this->minLength("headline", 10)) {
            $this->errors["headline"] = "Please enter a headline with at least 10 characters";
        }
        else if (!$this->maxLength("headline", 255)) {
            $this->errors["headline"] = "Please enter a headline with at most 255 characters";
        }

        if (!$this->isPresent("article")) {
            $this->errors["article"] = "Please enter a article";
        }
        else if (!$this->minLength("article", 50)) {
            $this->errors["article"] = "Please enter a article with at least 50 characters";
        }

        $authors = Author::findAll();
        $validAuthors = array_map(function($a) { return $a->id; }, $authors);
        if (!$this->isPresent("author_id")) {
            $this->errors["author_id"] = "Please choose an author";
        }
        else if (!$this->isElement("author_id", $validAuthors)) {
            $this->errors["author_id"] = "Please choose a valid author";
        }

        $categories = Category::findAll();
        $validCategories = array_map(function($c) { return $c->id; }, $categories);
        if (!$this->isPresent("category_id")) {
            $this->errors["category_id"] = "Please choose a category";
        }
        else if (!$this->isElement("category_id", $validCategories)) {
            $this->errors["category_id"] = "Please choose a valid category";
        }

        $locations = Location::findAll();
        $validLocations = array_map(function($l) { return $l->id; }, $locations);
        if (!$this->isPresent("location_id")) {
            $this->errors["location_id"] = "Please choose a location";
        }
        else if (!$this->isElement("location_id", $validLocations)) {
            $this->errors["location_id"] = "Please choose a valid location";
        }

        $maxFileSize = 1 * 1024 * 1024; // 1 MB
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!$this->hasFile("img_url")) {
            $this->errors["img_url"] = "Please choose an image";
        }
        else if (!$this->hasFileType("img_url", $allowedTypes)) {
            $this->errors["img_url"] = "Please choose a valid image type";
        }
        else if (!$this->hasFileSize("img_url", $maxFileSize)) {
            $this->errors["img_url"] = "Please choose an image with a size less than 1 MB";
        }

        return count($this->errors) === 0;
    }
}
?>