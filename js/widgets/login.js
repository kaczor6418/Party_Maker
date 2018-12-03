import {validation} from "../helpers/validation.js";

export function login(loginForm) {

    const inputFields = Array.from(loginForm.querySelectorAll('[data-error]'));
    const formType = 'login';
    loginForm.addEventListener('submit', e => {
        e.preventDefault();
        validation(inputFields, loginForm, formType);
    }, false);

}