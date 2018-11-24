import {createRegExp} from "./createRegExp.js";
import {regExpExpressions} from "../constantly/regExpExpressions.js";

function setInvalidStyle(inputField) {
    inputField.style.border = '0.3rem solid #861e1ede';
    inputField.placeholder = inputField.dataset.error;
}

function setValidStyle(inputField) {
    inputField.style.border = '0.3rem solid #2a5419d1';

}

function ifContains(regExp, inputField) {
    if(regExp.test(inputField.value)) {
        setValidStyle(inputField);
        return true;
    } else {
        setInvalidStyle(inputField);
        return undefined;
    }

}

export function isUsername(inputField) {

    const regExp = createRegExp(regExpExpressions.username);
    return ifContains(regExp, inputField);

}

export function isPassword(inputField) {

    const regExp = createRegExp(regExpExpressions.password);
    return ifContains(regExp, inputField);
}

export function isNameOrSurname(inputField) {

    const regExp = createRegExp(regExpExpressions.nameOrSurname);
    return ifContains(regExp, inputField);

}

export function isEmail(inputField) {

    const regExp = createRegExp(regExpExpressions.email);
    return ifContains(regExp, inputField);

}

export function isBirthDate(inputField) {

    const regExp = createRegExp(regExpExpressions.birthDate);
    return ifContains(regExp, inputField);

}