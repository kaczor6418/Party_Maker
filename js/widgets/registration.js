import {formValidation} from "../helpers/formValidation.js";

export function registration(loginForm) {

    const inputFields = Array.from(loginForm.querySelectorAll('[data-error]'));

    loginForm.addEventListener('submit', e => {
        e.preventDefault();
        formValidation(inputFields);
    }, false);

}