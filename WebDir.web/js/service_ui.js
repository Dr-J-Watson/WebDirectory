import Handlebars from 'handlebars';
import loader from "./loader.js";

async function displayService(data) {
    loader.loadService(data.id).then(service => {;
        const container = document.getElementById('#main');
        const templateSource = document.querySelector('#serviceTemplate').innerHTML;
        const template = Handlebars.compile(templateSource);
        const html = template(service);
        container.innerHTML = html;
    });
}

export default { displayService };