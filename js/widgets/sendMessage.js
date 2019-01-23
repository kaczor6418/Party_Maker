import {AJAX} from "../libraries/Ajax.js";
import {showMessage} from "../helpers/showMessage.js";
import {clearEventContainer} from "../utils/clearEventContainer.js";
import {printEvents} from "./printEvents.js";
import {sleep} from "../utils/sleep.js";

export function sendMessage(inputFields, form, formType) {
    if(!Array.isArray(inputFields)) {
        return;
    }
    const data = {};
    inputFields.forEach(field => {
        data[field.name] = field.value;
    });
    delete data[formType];
    data['formName'] = formType;
    AJAX({
        type: form.getAttribute('method'),
        url: form.getAttribute('action'),
        data: data,
        success: function (response) {
            const res = JSON.parse(response);
            if ('error' in res) {
                showMessage('error', res );
            } else if ('success' in res) {
                if('forPrinting' in res['success']) {
                    if (res['success']['clear']) {
                        clearEventContainer();
                    }
                    printEvents(res['success']['forPrinting']);
                } else {
                    showMessage('success', res );
                    form.removeEventListener('submit', sendMessage, false);
                    form.querySelector('.button').setAttribute('disabled', 'disabled');
                    sleep(3*1000).then(() => {
                        location.replace('/Party_Maker/mainPage.html');
                    });
                }
            }
        }
    });
    form.addEventListener('submit', sendMessage, false);

}
