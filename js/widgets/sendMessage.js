import {AJAX} from "../libraries/Ajax.js";
import {showMessage} from "../helpers/showMessage.js";
import {printEvents} from "./printEvents.js";
import {sleep} from "../utils/sleep.js";

export function sendMessage(inputFields, form, formType) {
    if(!Array.isArray(inputFields)) {
        return;
    }
    const data = {};
    inputFields.forEach(field => {
        data[field.name] = field.value
    });
    data[formType] = formType;
    AJAX({
        type: form.getAttribute('method'),
        url: form.getAttribute('action'),
        data: data,
        success: function (response) {
            response = `{ "success": {
                            "forPrinting": [
                                {
                                    "id": 1234,
                                    "name": "Ostro",
                                    "members": 666,
                                    "category": "sex",
                                    "date": "30.02.1990",
                                    "localization": "deathStar",
                                    "picture": "ascacsaac"
                                },
                                {
                                    "name": "jebacPsY",
                                    "members": 777,
                                    "category": "orgia",
                                    "date": "31.02.1990",
                                    "localization": "ostreRuchansko"
                                }
                            ]
                        }}`;
            const res = JSON.parse(response);
            if ('error' in res) {
                showMessage('error', res );
            } else if ('success' in res) {
                console.log(res['success']);
                if('forPrinting' in res['success']) {
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