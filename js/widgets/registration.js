import {formValidation} from "../helpers/formValidation.js";

export function registration(signUpForm) {

    const inputFields = Array.from(signUpForm.querySelectorAll('[data-error]'));
    const formType = 'signUp';
    signUpForm.addEventListener('submit', e => {
        e.preventDefault();
        formValidation(inputFields, signUpForm, formType);
    }, false);

}