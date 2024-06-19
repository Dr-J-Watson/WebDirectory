import loader_default from './js/loader';
import entree_ui from './js/entree_ui';
import searchEntrees_ui from './js/searchEntrees_ui';
import serviceEntrees_ui from './js/serviceEntrees_ui';
import allEntrees_ui from './js/allEntrees_ui';
import conf from './js/config';

function getAllEntrees(tri=""){
    loader_default.loadAllEntrees(tri)
    .then(data => {
        data.json().then(async data => {
            await allEntrees_ui.displayAllEntrees(data.entrees);
            addEvent();
        });
    });
}

function getEntree(url){
    loader_default.loadEntree(url)
    .then(data => {
        data.json().then(async data => {
            await entree_ui.displayEntree(data.entree);
            addEvent();
        });
    });
}

function getSearchEntrees(text){
    loader_default.loadSearchEntrees(text)
    .then(data => {
        data.json().then(async data => {
            await searchEntrees_ui.displaySearchEntrees(data.entrees, 'Aucun tri de service');
            addEvent();
        });
    });
}

function getServiceSearchEntrees(url, tri="Aucun tri de service"){
    loader_default.loadServiceSearchEntrees(url)
    .then(data => {
        data.json().then(async data => {
            await searchEntrees_ui.displaySearchEntrees(data, tri);
            addEvent();
        });
    });
}

function addEvent(){
    let tri;
    // Ajout des événements sur le bouton de retour à la liste des entrées
    if(document.getElementById('home') !== null){
        document.getElementById('home').addEventListener('click', function(){
                getAllEntrees();
        });
    }
    if(document.getElementById('searchInput') !== null){
        //simuler un click sur le bouton de recherche si on appuie sur entrée
        document.getElementById('searchInput').addEventListener('keyup', function(e){
            if(e.keyCode === 13){
                document.getElementById('search').click();
            }
        });
    }
    // Ajout des événements sur le bouton de recherche
    if(document.getElementById('search') !== null){
        document.getElementById('search').addEventListener('click', async function(){
            if(document.getElementById('tri') !== null){
                tri = document.getElementById('tri').value;
            }
            if(document.getElementById('searchInput').value !== '' && document.getElementById('select').value !== '/api/entrees'){
                let service = document.getElementById('select').options[document.getElementById('select').selectedIndex].text;
                if(tri !== ""){
                    getServiceSearchEntrees(document.getElementById('select').value + '/search?q=' + document.getElementById('searchInput').value + '&' + tri, service);
                }else{
                    getServiceSearchEntrees(document.getElementById('select').value + '/search?q=' + document.getElementById('searchInput').value  + tri, service);
                }
            }else if(document.getElementById('searchInput').value !== ''){
                if(tri !== ""){
                    getSearchEntrees(document.getElementById('searchInput').value + '&' + tri);
                }else{
                    getSearchEntrees(document.getElementById('searchInput').value);
                }
            }else if(document.getElementById('select').value !== '/api/entrees'){
                if(tri !== ""){
                    await serviceEntrees_ui.displayServiceEntrees(document.getElementById('select').value + '?' + tri);
                }else{
                    await serviceEntrees_ui.displayServiceEntrees(document.getElementById('select').value);
                }
            }else{
                getAllEntrees(tri);
            }
            addEvent();
        });
    }
    // Ajout des événements sur le bouton de visualisation d'une entrée
    if(document.getElementsByClassName('voir') !== null){
        const voir = document.getElementsByClassName('voir');
        for(let i = 0; i < voir.length; i++){
            voir[i].addEventListener('click', function(e){
                let url = e.target.getAttribute('url');
                url = conf.url + url;
                getEntree(url);
            });
        }
    }
}

getAllEntrees();