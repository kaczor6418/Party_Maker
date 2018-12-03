import {validation} from "../helpers/validation.js";

export function addInteraction(form, formType) {

    const inputFields = Array.from(form.querySelectorAll('[data-error]'));
    form.addEventListener('submit', e => {
        e.preventDefault();
        validation(inputFields, form, formType);
    }, false);

}