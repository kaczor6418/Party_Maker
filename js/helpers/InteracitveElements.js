export class InteracitveElements {

    constructor(elementsNames) {

        this.actionElements = {};
        elementsNames.forEach( elementName => {
            let keyName = elementName;
            if(elementName.startsWith('.')){
                keyName = elementName.replace(/\./, '');
            }
            this.actionElements[keyName] = Array.from(document.querySelectorAll(elementName));
        } );

    }

}