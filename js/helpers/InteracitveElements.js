export class InteracitveElements {

    constructor(elementsNames) {

        this.actionElements = {};
        elementsNames.forEach( elementName => {
            this.actionElements[`${elementName}s`] = Array.from(document.querySelectorAll(elementName));
        } );

    }

}