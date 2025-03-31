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


        // if (!this.isPresent("description")){
        //     this.errors["description"] = "Description is required";
        // }
        // else if (!this.minLength("description", 20)) {
        //     this.errors["description"] = "Description must at least be 20 characters long";
        // }

        // if (!this.isPresent("code")){
        //     this.errors["code"] = "Course code is required";
        // }
        // else if (!this.isMatch("code", /^[A-Z]{3}-[0-9]{4}$/)){
        //     this.errors["code"] = "Course code must have format: [ABC-1234]";
        // }

        // let validDepartments = this.getOptions('#department_id');
        // if (!this.isPresent("department_id")) {
        //     this.errors["department_id"] = "Please choose a department";
        // }
        // else if (!this.isElement ("department_id", validDepartments)){
        //     this.errors["department_id"] = "Please choose a department";
        // }

        // let validModules = this.getOptions('#module_id');
        // if (!this.isPresent("module_id[]")) {
        //     this.errors["module_id"] = "Please choose a module";
        // }
        // else if (!this.isSubset("module_id[]", validModules)){
        //     this.errors["module_id"] = "Please choose a module";
        // }


        return Object.keys(this.errors).length === 0;
    }
}

export default AuthorFormValidator;