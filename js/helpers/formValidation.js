import {isSth} from "./isSth.js";
import {sendMessage} from "./sendMessage.js";

export function formValidation(inputFields, form, formType) {

    const errors = [];

    inputFields.forEach(inputField => {

        let isValid;

        isValid = isSth(inputField);
        if (!isValid) {
            errors.push(inputField.dataset.error);
        }

    });
    if(errors.length) {
        //displayErrors(errors); for example we can show errors in console
    } else {
        sendMessage(inputFields, form, formType);
    }

}