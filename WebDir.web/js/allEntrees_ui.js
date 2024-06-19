import Handlebars from 'handlebars';
import conf from './config.js';

async function displayAllEntrees(data){
    let images = {};
    let initiales = [];
    for(let i = 0; i < data.length; i++){
        initiales[i] = data[i].entree.firstName[0] + data[i].entree.lastName[0];
        await fetch(conf.url + data[i].links.self.href).then(data => data.json()).then(entree => {
            if(entree.entree.image !== null){
                images[i] = conf.imgurl + entree.entree.image;
            }else{
                images[i] = null;
            }
        }).catch(error => {
            console.error('Erreur lors de la récupération de l\'image');
        }
        );
    }
    for(let i = 0; i < data.length; i++){
        data[i].entree.image = images[i];
        data[i].entree.initiales = initiales[i];
    }
    const container = document.getElementById('main');
    const templateSource = document.getElementById('listEntreeTemplate').innerHTML;
    const template = Handlebars.compile(templateSource);
    let services = await fetch(conf.url + '/api/services').then(data => data.json());
    const html = template({entrees : data, services : services.services, tri : 'Aucun tri', images : images, initiales : initiales});  
    container.innerHTML = html;

    
}

export default { displayAllEntrees };