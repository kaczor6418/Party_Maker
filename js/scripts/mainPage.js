import {InteracitveElements} from "../helpers/InteracitveElements.js";
import {addInteraction} from "../widgets/addInteraction.js";

(function () {

    const mainPage = new InteracitveElements(['form']);
    mainPage.actionElements.forms.forEach(form => {
        addInteraction(form, form.className);
    })
})();