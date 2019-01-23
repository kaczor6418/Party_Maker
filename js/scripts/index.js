import {InteracitveElements} from "../helpers/InteracitveElements.js";
import {addFormInteraction} from "../widgets/addFormInteraction.js";

(function () {

    const index = new InteracitveElements(['form']);
    addFormInteraction(index.actionElements.form[0], 'login');

})();
