import conf from './config.js';

async function loadEntree(url){
    return fetch(url).catch(error => {
        console.error('Erreur lors de la récupération de l\'entrée');
    });
}

function loadService(idService){
    url = conf.url + 'api/services/';
    return fetch(url + idService).catch(error => {
        console.error('Erreur lors de la récupération du service');
    });
}

function loadAllEntrees(){
    url = conf.url + '/api/entrees';
    return fetch(url).catch(error => {
        console.error('Erreur lors de la récupération des entrées');
    });
}

export default { loadEntree, loadService, loadAllEntrees };