<?php
class LocationFormValidator extends FormValidator {
    public function __construct ($data=[]) {
        parent::__construct($data);
    }

    //The requirments to made
    public function validate() {
        //Table -- locations

        //Name
        if(!$this->isPresent("name")) {
            $this->errors["name"] = "Please state the Name";
        }

        return count($this->errors) === 0;
    }
}
?>