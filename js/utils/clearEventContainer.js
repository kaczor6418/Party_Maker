export function clearEventContainer() {
    const events = document.querySelector('.events__container--allEvents');
    while (events.firstChild) {
        events.removeChild(events.firstChild);
    }
}
