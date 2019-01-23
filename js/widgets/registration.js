import {validation} from "../helpers/validation.js";

export function registration(signUpForm) {

    const inputFields = Array.from(signUpForm.querySelectorAll('[data-error]'));
    const formType = 'signUp';
    signUpForm.addEventListener('submit', e => {
        e.preventDefault();
        validation(inputFields, signUpForm, formType);
    }, false);

}