import {createEvent} from "../utils/createEvent.js";

export function printEvents(events) {

    const renderContainer = document.querySelector('.events__container--allEvents');

    events.forEach(event => {
        renderContainer.appendChild(createEvent(event));
    });

}