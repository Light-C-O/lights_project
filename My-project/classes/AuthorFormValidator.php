<?php
class AuthorFormValidator extends FormValidator {
    public function __construct ($data=[]) {
        parent::__construct($data);
    }

    //The requirments to made
    public function validate() {
        //Table -- authors

        //First name
        if(!$this->isPresent("first_name")) {
            $this->errors["first_name"] = "Please state the First Name";
        }

        //Last name
        if(!$this->isPresent("last_name")) {
            $this->errors["last_name"] = "Please state the Last Name";
        }
        return count($this->errors) === 0;
    }
}
?>