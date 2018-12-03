import {InteracitveElements} from "../helpers/InteracitveElements.js";
import {addInteraction} from "../widgets/addInteraction.js";

(function () {

    const index = new InteracitveElements(['form']);
    addInteraction(index.actionElements.forms[0], 'login');

})();
