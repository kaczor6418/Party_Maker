import {isNameOrSurname, isEmpty, isAtLeast, isEmail, isPhoneNo, isUser, isPass, isBirthDate} from "./isSth.js";

export function validation(form) {

    const fields = form.querySelectorAll('[data-error]');

    let errors = [];

    fields.forEach(field => {

        let isValid = null;

        switch (field.name) {
            case 'name':
                isValid = isNameOrSurname(field);
                break;
            case 'lastName':
                isValid = isNameOrSurname(field);
                break;
            case 'user':
                isValid = isUser(field);
                break;
            case 'pass':
                isValid = isPass(field);
                break;
            case 'birddt':
                isValid = isBirthDate(field);
                break;
            case 'email':
                isValid =  isEmail(field);
                break;
            case 'phoneNo':
                isValid =  isPhoneNo(field);
                break;
            case 'subject':
                isValid = isEmpty(field);
                break;
            case 'message':
                isValid = isAtLeast(field, 3);
                break;
            default:
        }

        if (!isValid) {
            field.classList.add('error');
            errors.push(field.dataset.error);
        }else {
            field.classList.remove('error');
        }
    })
    if(!errors.length) {
        return true;
    }
}
