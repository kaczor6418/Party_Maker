import {fontawesomeStyles} from "../constantly/fontawesomeStyles.js";
import {setInputStyle} from "./setStyle.js";
import {sleep} from "../utils/sleep.js";

export function showMessage(type, response) {

    const serverInfo = document.querySelector('serverInfo');

    if(serverInfo){
        document.querySelector('body').removeChild(serverInfo);
    }

    const parent = document.querySelector('body');
    const divInfo = document.createElement('div');
    const labelText = document.createElement('label');
    const infoIcon = document.createElement('i');

    divInfo.className = `${type}Server`;
    divInfo.classList.add('serverInfo');
    labelText.textContent = response[type].info;
    infoIcon.className = fontawesomeStyles[type].class;
    infoIcon.style.color = fontawesomeStyles[type].color;
    labelText.appendChild(infoIcon);
    divInfo.appendChild(labelText);
    parent.appendChild(divInfo);

    if('errorFields' in response[type]) {
        let inputField;
        for(const fieldName of response[type]['errorFields']) {
            inputField = document.querySelector(`#${fieldName}`);
            setInputStyle(inputField, type);
        }
    }

    const showMessageDuration = 10 * 1000;
    sleep(showMessageDuration).then(() => {
        if (serverInfo) {
            parent.removeChild(divInfo);
        }
    });

}