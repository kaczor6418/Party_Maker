import {AJAX} from "../libraries/AJAX.js";

function showMessage(type, msg) { // it is to print server error (login/register successful or unsuccessful)
    let messageParent = document.querySelector('.status'),  // we have to decide where we want to print errors so now it is abstract(.status doesn't exist)
        existingMessage = document.querySelector('.status .errors');
    if (messageParent.hasChildNodes()) {
        while (messageParent.firstChild) {
            messageParent.removeChild(messageParent.firstChild);
        }
    }
    if(existingMessage){
        existingMessage.textContent = msg;
    } else {
        let messageContainer = document.createElement('div'),
            message = document.createElement('label');

        messageContainer.className = type;
        message.textContent = msg;
        messageContainer.appendChild(message);
        messageParent.appendChild(messageContainer);
    }
}

export function sendForm(form) {
    let fields = form.querySelectorAll('input'),
        data = {};
    [].forEach.call(fields, function(field) {
        data[field.name] = field.value;
    });
    AJAX({
        type: form.getAttribute("method"),
        url: form.getAttribute("action"),
        data: data,
        success: function(response) {
            let res = JSON.parse(response);
            if("error" in res) {
                showMessage("serverError", res.error);
            } else if("success" in res) {
                showMessage("serverSuccess", res.success);
                form.removeEventListener("submit", sendMessage, false);
                form.querySelector("button").setAttribute("disabled", "disabled");
            }
        }
    });
    form.addEventListener('submit', sendMessage, false);
}