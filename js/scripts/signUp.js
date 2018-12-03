import {InteracitveElements} from "../helpers/InteracitveElements.js";
import {addInteraction} from "../widgets/addInteraction.js";

(function () {

    const signUp = new InteracitveElements(['form']);
    addInteraction(signUp.actionElements.forms[0], 'signUp');

})();