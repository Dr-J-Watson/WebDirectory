import Handlebars from 'handlebars';
import conf from "./config.js";

function displayEntree(data) {
    const urlserv = conf.urlserv;
    const container = document.getElementById('#main');
    const templateSource = document.querySelector('#entreeTemplate').innerHTML;
    const template = Handlebars.compile(templateSource);
    const html = template(data);
    container.innerHTML = html;
}

export default { displayEntree };