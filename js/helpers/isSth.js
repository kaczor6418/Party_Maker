import {createRegExp} from "./createRegExp.js";

function isEmpty(inputField) {
    if(inputField.value = '') {
        return false;
    }
    return true;
}

export function isUsername(inputField) {

    const minCharacters = 3;

    if (inputField.value.length > minCharacters) {
        inputField.style.background = '#b7eab4';
        return true;
    } else {
        inputField.style.background = '#e9e1b0';
        inputField.placeholder = inputField.dataset.error;
        return undefined;
    }

}

export function isPassword(inputField) {
    const regExp = createRegExp('"^(?=.*[a-z])(?=.*[A-Z])(?=.*\\d)(?=.*[@$!%*?&])[A-Za-z\\d@$!%*?&]{8,}$"');
    if(isEmpty(inputField)) {
        inputField.style.background = '#e9e1b0';
        inputField.placeholder = inputField.dataset.error;;
        return undefined;
    } else {
        if(regExp.test(inputField.value)) {
            return true;
        } else {
            return undefined;
        }
    }
}