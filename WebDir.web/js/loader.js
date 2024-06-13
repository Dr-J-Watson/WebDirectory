import conf from './config.js';

function loadEntree(idEntree){
    url = conf.url + '/entrees/';
    fetch(url + idEntree)
    .then(response => {
        if (response.ok) {
            return response.json();
        } else {
            throw new Error('Erreur lors de la récupération de l\'entrée');
        }
    });
}

function loadService(idService){
    url = conf.url + '/service/';
    fetch(url + idService)
    .then(response => {
        if (response.ok) {
            return response.json();
        } else {
            throw new Error('Erreur lors de la récupération du service');
        }
    });
}

