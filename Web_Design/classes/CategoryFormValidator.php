<?php
class CategoryFormValidator extends FormValidator {
    public function __construct ($data=[]) {
        parent::__construct($data);
    }

    //The requirments to made
    public function validate() {
        //Table -- category

        //Name
        if(!$this->isPresent("name")) {
            $this->errors["name"] = "Please state the Name";
        }

        return count($this->errors) === 0;
    }
}
?>