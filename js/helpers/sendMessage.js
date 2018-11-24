import {AJAX} from "../libraries/Ajax.js";

export function sendMessage(inputFields, form) {

    const data = {};
    inputFields.forEach(field => {
        data[field.name] = field.value
    });
    AJAX({
        type: form.getAttribute('method'),
        url: form.getAttribute('action'),
        data: data,
        success: function (response) {
            console.log(response);
            /*const res = JSON.parse(response);
            if ('error' in res) {
                // show error message
            } else if ('success' in res) {
                // show success message
                form.removeEventListener('submit', sendMessage, false);
                form.querySelector('.button').setAttribute('disabled', 'disabled');
            }*/
        }
    });
    form.addEventListener('submit', sendMessage, false);

}