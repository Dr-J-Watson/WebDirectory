import Handlebars from 'handlebars';
import conf from "./config.js";

async function displayEntree() {
    const urlserv = conf.urlserv;
    const container = document.getElementById('#main');
    const templateSource = document.querySelector('#listEntreeTemplate').innerHTML;
    const template = Handlebars.compile(templateSource);
    let data = await fetch(url + '/entrees/');
    if (data.ok) {
        data = await data.json();
    } else {
        throw new Error('Erreur lors de la récupération des entrées');
    }
    const html = template(data);
    container.innerHTML = html;
}