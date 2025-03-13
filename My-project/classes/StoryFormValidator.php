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
            $this->errors["status"] = "Please state the status";
        }
        else if(!$this->maxLength("status", 1)) {
            $this->errors['status'] = "Status must be no more then 1 characters long";
        }
        else if(!$this->isMatch("status", '/^[0-1]{1}$/')) {
            $this->errors['status'] = "Must be exactly 1 character. Format: [1 = live 0 = not live]";
        }

        //Description
        if(!$this->isPresent("description")) {
            $this->errors["description"] = "Please state the description";
        }
        else if(!$this->minLength("description", 20)) {
            $this->errors['description'] = "Must be aleast 20 characters long";
        }
        else if(!$this->maxLength("description", 256)) {
            $this->errors['description'] = "Description must be no more 256 characters long";
        }

        //Code
        if(!$this->isPresent("code")) {
            $this->errors["code"] = "Please state the code";
        }
        else if(!$this->isMatch("code", '/^[A-Z]{3}-[0-9]{4}$/')) {
            $this->errors['code'] = "Must be exactly 8 characters. Format: [ABC-1234]";
        }

        //Department
        if(!$this->isPresent("department_id")) {
            $this->errors["department_id"] = "Please state the department";
        }

        return count($this->errors) === 0;
    }
}
?>