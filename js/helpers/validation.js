import {isSth} from "./isSth.js";
import {sendMessage} from "../widgets/sendMessage.js";

export function validation(inputFields, form, formType) {

    let errors = [];

    inputFields.forEach(inputField => {

        let isValid;

        isValid = isSth(inputField);
        if (!isValid) {
            errors.push(inputField.dataset.error);
        }

    });

    if(formType === 'filter' && errors.length < inputFields.length) {
        errors = [];
    }

    if(errors.length) {
        //displayErrors(errors); for example we can show errors in console
    } else {
        sendMessage(inputFields, form, formType);
    }

}
