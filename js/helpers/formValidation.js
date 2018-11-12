import {isUsername, isPassword} from "./isSth.js";

export function formValidation(inputFields) {

    const errors = [];

    inputFields.forEach(inputField => {

        let isValid = null;

        switch (inputField.name) {
            case 'username':
                isValid = isUsername(inputField);
                break;
            case 'password':
                isValid = isPassword(inputField);
                break;
            default:
                console.log('Invalid filed name!!!');
        }

        if (!isValid) {
            inputField.classList.add('error');
            errors.push(inputField.dataset.error);
        }else {
            field.classList.remove('error');
        }

    });
    if(errors.length) {
        //displayErrors(errors);
    }

}