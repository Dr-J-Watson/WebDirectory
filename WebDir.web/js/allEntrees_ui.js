import Handlebars from 'handlebars';
import conf from './config.js';

async function displayAllEntrees(data){
    const container = document.getElementById('main');
    const templateSource = document.getElementById('listEntreeTemplate').innerHTML;
    const template = Handlebars.compile(templateSource);
    let services = await fetch(conf.url + '/api/services').then(data => data.json());
    const html = template({entrees : data, services : services.services, tri : 'Aucun tri'});  
    container.innerHTML = html;
}

export default { displayAllEntrees };