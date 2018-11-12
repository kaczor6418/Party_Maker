import {isUsername, isPassword, isNameOrSurname, isEmail, isBirthDate} from "./isSth.js";

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
            case 'name':
                isValid = isNameOrSurname(inputField);
                break;
            case 'surname':
                isValid = isNameOrSurname(inputField);
                break;
            case 'email':
                isValid = isEmail(inputField);
                break;
            case 'birthDate':
                isValid = isBirthDate(inputField);
                break;
            default:
                console.log('Invalid filed name!!!');
        }

        if (!isValid) {
            errors.push(inputField.dataset.error);
        }

    });
    if(errors.length) {
        //displayErrors(errors); for example we can show errors in console
    } else {
        //sendMessage
    }

}