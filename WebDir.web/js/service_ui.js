import Handlebars from 'handlebars';
import conf from "./config.js";

function displayService(data) {
    const urlserv = conf.urlserv;
    const container = document.getElementById('#main');
    const templateSource = document.querySelector('#serviceTemplate').innerHTML;
    const template = Handlebars.compile(templateSource);
    const html = template(data);
    container.innerHTML = html;
}

export default { displayService };