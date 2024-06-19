import Handlebars from "handlebars";
import conf from "./config.js";

async function displayServiceEntrees(url) {
    const container = document.getElementById("main");
    const templateSource = document.getElementById("listEntreeTemplate").innerHTML;
    const template = Handlebars.compile(templateSource);
    let data = await fetch(conf.url + url).then(data => data.json());
    let images = {};
    for(let i = 0; i < data.entrees.length; i++){
        await fetch(conf.url + data.entrees[i].links.self.href).then(data => data.json()).then(entree => {
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
    for(let i = 0; i < data.entrees.length; i++){
        data.entrees[i].entree.image = images[i];
    }
    let services = await fetch(conf.url + '/api/services').then(data => data.json());
    if(data.service == null){
        data.service = 'Aucun tri';
    }
    const html = template({entrees : data.entrees, services : services.services, tri : data.service});
    container.innerHTML = html;
}

export default { displayServiceEntrees };