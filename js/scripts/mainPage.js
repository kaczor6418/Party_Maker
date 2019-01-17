import {InteracitveElements} from "../helpers/InteracitveElements.js";
import {addFormInteraction} from "../widgets/addFormInteraction.js";
import {printEvents} from "../widgets/printEvents.js";
import {hideOrShow} from "../utils/hideOrShow.js";
import {AJAX} from "../libraries/Ajax.js";

(function () {

    const data = {
        info: "mainPageStart"
    };
    AJAX({
        type: 'post',
        url: 'module.php',
        data: data,
        success: function (response) {
            const res = JSON.parse(response);
            if ('success' in res) {
                printEvents(res['success']['forPrinting']);
            }
        }
    });



    const mainPage = new InteracitveElements(['form','.logout']);
    mainPage.actionElements.form.forEach(form => {
        addFormInteraction(form, form.className);
    });
    mainPage.actionElements.logout[0].addEventListener('click', e => {
        e.preventDefault();
        const userOptions = document.querySelector('.user__options');
        hideOrShow(userOptions);
    });
})();
