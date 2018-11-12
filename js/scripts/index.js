import {InteracitveElements} from "../helpers/InteracitveElements.js";
import {login} from "../widgets/login.js";

(function () {
    const index = new InteracitveElements(['form']);
    login(index.actionElements.forms[0]);
})();
