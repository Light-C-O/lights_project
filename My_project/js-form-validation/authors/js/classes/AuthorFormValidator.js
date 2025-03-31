import FormValidator from "./FormValidator.js";

class AuthorFormValidator extends FormValidator{
    constructor(_form){
        super(_form);
    }

    validate(){
        if (!this.isPresent("first_name")){
            this.errors["first_name"] = "First Name is required";
        }
        if (!this.isPresent("last_name")){
            this.errors["last_name"] = "Last Name is required";
        }

        return Object.keys(this.errors).length === 0;
    }
}

export default AuthorFormValidator;