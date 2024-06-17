import conf from './config.js';

async function loadEntree(idEntree){
    url = conf.url + '/api/entrees/';
    await fetch(url + idEntree, {credentials: 'include'})
    .then(response => {
        if (response.ok) {
            return response.json();
        } else {
            throw new Error('Erreur lors de la récupération de l\'entrée');
        }
    });
}

function loadService(idService){
    url = conf.url + 'api/services/';
    fetch(url + idService)
    .then(response => {
        if (response.ok) {
            return response.json();
        } else {
            throw new Error('Erreur lors de la récupération du service');
        }
    });
}

function loadEntrees(){
    url = conf.url + '/api/entrees';
    fetch(url)
    .then(response => {
        if (response.ok) {
            return response.json();
        } else {
            throw new Error('Erreur lors de la récupération des entrées');
        }
    });
}

export default { loadEntree, loadService, loadEntrees };