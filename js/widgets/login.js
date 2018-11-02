import {validation} from '../helpers/validation.js';
import {sendForm} from "../helpers/sendForm.js";

export function login(button, form) {
    button.addEventListener('submit', e => {
        e.preventDefault();
        if(validation(form)){
            sendForm(form);
        }
    })
}