import Handlebars from 'handlebars';
import conf from "./config.js";
import loader from "./loader.js";

function displayEntree(data) {
    loader.loadEntree(data.id).then(entree => {
        const urlserv = conf.urlserv;
        const container = document.getElementById('#main');
        const templateSource = document.querySelector('#entreeTemplate').innerHTML;
        const template = Handlebars.compile(templateSource);
        const html = template(entree);
        container.innerHTML = html;
    });
}

export default { displayEntree };