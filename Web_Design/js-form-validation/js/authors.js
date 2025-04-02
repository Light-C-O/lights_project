import AuthorFormValidator from "./classes/AuthorFormValidator.js";

document.addEventListener("DOMContentLoaded", function(event){
    let form = document.querySelector('#form-author');
    let table = document.querySelector('#table-authors');
    let tbody = table.querySelector("tbody");
    let btn = document.querySelector("#btn-submit");

    // let authorSelect = document.querySelector("#first_name");
    // let authorOptions = authorSelect.options;
    // authorOptions = Array.from(authorOptions);
    // let authorOptionsArray = {};
    // authorOptions.forEach((autOption) => {
    //     let value = autOption.value;
    //     let name = autOption.textContent;
    //     if (value !== "") {
    //         authorOptionsArray[value] = name;
    //     }
    // })
    // console.log(authorOptionsArray);

    //Add an event listener for btn when it comes to click
    btn.addEventListener("click", async function(event){
        event.preventDefault();

        let validator = new AuthorFormValidator(form);
        validator.clearErrors();

        let valid = validator.validate();
        if(valid){
            try{
                let response = await storeAuthor_Demo(validator.data);
                if (response.status == true){
                    insertRow(validator.data);
                    form.reset();
                }
                else{
                    throw new Exception ("Error storing author");
                }
            }
            catch (e){
                // console.log(e);
                alert("Error storing author");
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
            }
            cell.innerHTML = text;
        }

    }

    async function storeAuthor_Demo(data) {
        const url = "php/js_author_demo_store.php";
        const response = await fetch(url, {
            method: "POST",
            body: JSON.stringify(data),
            headers: {
                "Content-Type": "application/json",
            }
        });
        if (!response.ok) {
            throw new Exception(`Response status: ${response.status}`);
        }
        const json = await response.json();
        return json;
    }
});