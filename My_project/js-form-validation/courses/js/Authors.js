import AuthorFormValidator from "./classes/AuthorFormValidator.js";

document.addEventListener("DOMContentLoaded", function(event){
    let form = document.querySelector('#form-author');
    let table = document.querySelector('#table-authors');
    let tbody = table.querySelector("tbody");
    let btn = document.querySelector("#btn-submit");

    //Add an event listener for btn when it comes to click
    btn.addEventListener("click", async function(event){
        event.preventDefault();

        let validator = new AuthorFormValidator(form);
        validator.clearErrors();

        let valid = validator.validate();
        if(valid){
            try{
                let response = await storeauthor(validator.data);
                if (response.status == true){
                    insertRow(validator.data);
                    form.reset();
                }
                else{
                    throw new Exception ("Error storing card");
                }
            }
            catch (e){
                console.log(e.getMessage());
                alert("Error storing card");
            }
        }
        else{
            validator.showErrors();
        }
    });

    function insertRow(data){
        let row = tbody.insertRow();
        for(let i=0; i != 2; i++){
            let cell = row.insertCell();
            let text = null;

            switch(i){
                case 0: text = data.first_name; break;
                case 1: text = data.last_name; break;
                // case 2: text = data.code; break;
                // case 3: text = data.department_id; break;
                // case 4: text = data.module_id; break;
            }
            cell.innerHTML = text;
        }

    }
});