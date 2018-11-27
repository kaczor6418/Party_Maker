import {createRegExp} from "./createRegExp.js";
import {setInputStyle} from "./setStyle.js";
import {regExpExpressions} from "../constantly/regExpExpressions.js";

function ifContains(regExp, inputField) {

    if(regExp.test(inputField.value)) {
        setInputStyle(inputField, 'success');
        return true;
    } else {
        setInputStyle(inputField, 'error');
        return undefined;
    }

}

export function isSth(inputField) {

    const regExp = createRegExp(regExpExpressions[inputField.name]);
    return ifContains(regExp, inputField);

}