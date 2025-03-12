<?php
class CourseFormValidator extends FormValidator {
    public function __construct ($data=[]) {
        parent::__construct($data);
    }

    //The requirments to made
    public function validate() {
        //Table -- courses

        //Title
        if(!$this->isPresent("title")) {
            $this->errors["title"] = "Please state the title";
        }
        else if(!$this->maxLength("title", 128)) {
            $this->errors['title'] = "Title must be no more 128 characters long";
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