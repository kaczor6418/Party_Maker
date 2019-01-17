import {InteracitveElements} from "../helpers/InteracitveElements.js";
import {addFormInteraction} from "../widgets/addFormInteraction.js";

(function () {

    const signUp = new InteracitveElements(['form']);
    addFormInteraction(signUp.actionElements.form[0], 'signUp');

})();