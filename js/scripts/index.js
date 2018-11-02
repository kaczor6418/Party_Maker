import { createMapOfNodes } from '../helpers/createMapOfNodes.js';
import {login} from "../widgets/login.js";

(function () {

    const index = new Map();

    index.set('buttons', createMapOfNodes('.button'));
    index.set('fields', createMapOfNodes('.inputText'));
    const form = document.querySelector('.form'),
          loginButton = index.get('buttons').get('signIn');
    login(loginButton, form);

})();