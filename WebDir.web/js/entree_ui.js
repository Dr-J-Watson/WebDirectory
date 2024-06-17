import Handlebars from 'handlebars';
import conf from './config.js';

async function displayEntree(data){
    const container = document.getElementById('main');
    const templateSource = document.getElementById('entreeTemplate').innerHTML;
    const template = Handlebars.compile(templateSource);
    let services = data.services;
    let image = conf.imgurl + data.image;
    let initiales = {nom : data.lastName[0], prenom : data.firstName[0]};
    let html;
    if(data.image === null){
        html = template({data : data, services : services, initiales : initiales});
    }else{
        html = template({data : data, services : services, image : image, initiales : initiales});
    }
    container.innerHTML = html;
}

export default { displayEntree };