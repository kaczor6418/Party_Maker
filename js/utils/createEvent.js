export function createEvent(event) {

    const eventContainer = document.createElement('div');
    const eventTitle = document.createElement('h3');
    const eventInfo = document.createElement('table');
    const infoHeaders = document.createElement("thead");
    const infoAboutEvent = document.createElement('tbody');
    const infoTitleRow = document.createElement('tr');
    const infoRow = document.createElement('tr');

    eventTitle.textContent = event['name'];
    for(const info in event){
        if(info != 'id' && info!='picture' && info != 'name') {
            const infoTitle = document.createElement('th');
            const infoInfo = document.createElement('td');
            infoTitle.textContent = info;
            infoInfo.textContent = event[info];
            infoTitleRow.appendChild(infoTitle);
            infoRow.appendChild(infoInfo);
        }
    }

    infoAboutEvent.appendChild(infoRow);
    infoHeaders.appendChild(infoTitleRow);
    eventInfo.appendChild(infoHeaders);
    eventInfo.appendChild(infoAboutEvent);
    eventContainer.appendChild(eventTitle);
    eventContainer.appendChild(eventInfo);

    eventContainer.className = 'event';

    return eventContainer;

}