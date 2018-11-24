import {InteracitveElements} from "../helpers/InteracitveElements.js";
import {registration} from "../widgets/registration.js";

(function () {

    const index = new InteracitveElements(['form']);
    registration(index.actionElements.forms[0]);

})();
