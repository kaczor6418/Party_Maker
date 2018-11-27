import {fontawesomeStyles} from "../constantly/fontawesomeStyles.js";

export function setInputStyle(inputField, type) {

    let info = inputField.parentNode.parentNode.parentNode;
    info = info.querySelector(`.${inputField.name}Information`);
    info.className = `${fontawesomeStyles[type].class} informationAboutField ${inputField.name}Information`;
    info.title = inputField.dataset[type];
    info.style.color = `${fontawesomeStyles[type].color}`;
    inputField.style.border = `${fontawesomeStyles[type].border} ${fontawesomeStyles[type].color}`;
    inputField.placeholder = inputField.dataset[type];

}