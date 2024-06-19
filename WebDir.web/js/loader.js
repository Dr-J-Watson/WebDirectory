import conf from './config.js';

async function loadEntree(url){
    return fetch(url).catch(error => {
        console.error('Erreur lors de la récupération de l\'entrée');
    });
}

function loadSearchEntrees(text){
    url = conf.url + '/api/entrees/search?q=';
    return fetch(url + text).catch(error => {
        console.error('Erreur lors de la récupération des entrées par recherche');
    });
}

function loadServiceSearchEntrees(url){
    url = conf.url + url;
    return fetch(url).catch(error => {
        console.error('Erreur lors de la récupération des entrées par recherche de service');
    });
}

function loadAllEntrees(tri){
    if(tri !== ''){
        tri = '?' + tri;
    }
    url = conf.url + '/api/entrees' + tri;
    return fetch(url).catch(error => {
        console.error('Erreur lors de la récupération des entrées');
    });
}

export default { loadEntree, loadSearchEntrees, loadAllEntrees, loadServiceSearchEntrees };