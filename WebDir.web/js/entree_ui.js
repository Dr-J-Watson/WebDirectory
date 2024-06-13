import Handlebars from 'handlebars';
import loader from "./loader.js";

function displayEntree(data) {
    loader.loadEntree(data.id).then(entree => {
        const container = document.getElementById('#main');
        const templateSource = document.querySelector('#entreeTemplate').innerHTML;
        const template = Handlebars.compile(templateSource);
        const html = template(entree);
        container.innerHTML = html;
    });
}

export default { displayEntree };