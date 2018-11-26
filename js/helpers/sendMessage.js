import {AJAX} from "../libraries/Ajax.js";
import {showMessage} from "./showMessage.js";

export function sendMessage(inputFields, form, formType) {
    console.log(inputFields);
    const data = {};
    console.log(inputFields);
    inputFields.forEach(field => {
        data[field.name] = field.value
    });
    data[formType] = formType;
    AJAX({
        type: form.getAttribute('method'),
        url: form.getAttribute('action'),
        data: data,
        success: function (response) {
            response = `{
                "error": {
                    "info": "error/success info",
                    "errorFields": "username,password"
                }
            }`;
            const res = JSON.parse(response);
            if ('error' in res) {
                showMessage('error', res );
            } else if ('success' in res) {
                showMessage('success', res );
                form.removeEventListener('submit', sendMessage, false);
                form.querySelector('.button').setAttribute('disabled', 'disabled');
            }
        }
    });
    form.addEventListener('submit', sendMessage, false);

}