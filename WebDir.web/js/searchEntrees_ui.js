import Handlebars from 'handlebars';
import conf from './config.js';

async function displaySearchEntrees(data, tri){
    for(let i = 0; i < data.length; i++){
        if(data[i].entree.image !== null){
            data[i].entree.image = conf.imgurl + data[i].entree.image;
        }
    }
    const container = document.getElementById('main');
    const templateSource = document.getElementById('listEntreeTemplate').innerHTML;
    const template = Handlebars.compile(templateSource);
    let services = await fetch(conf.url + '/api/services').then(data => data.json());
    if(data.length === 0){
        data = null;
    }
    const html = template({entrees : data, services : services.services, tri : tri});
    container.innerHTML = html;
}

export default { displaySearchEntrees };