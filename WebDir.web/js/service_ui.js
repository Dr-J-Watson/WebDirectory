import Handlebars from 'handlebars';
import conf from "./config.js";
import loader from "./loader.js";

async function displayService(data) {
    loader.loadService(data.id).then(service => {;
        const urlserv = conf.urlserv;
        const container = document.getElementById('#main');
        const templateSource = document.querySelector('#serviceTemplate').innerHTML;
        const template = Handlebars.compile(templateSource);
        const html = template(service);
        container.innerHTML = html;
    });
}

export default { displayService };