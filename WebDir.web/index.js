import loader_default from './js/loader';
import entree_ui from './js/entree_ui';
import serviceEntrees_ui from './js/serviceEntrees_ui';
import allEntrees_ui from './js/allEntrees_ui';
import conf from './js/config';

function getAllEntrees(){
    loader_default.loadAllEntrees()
    .then(data => {
        data.json().then(async data => {
            await allEntrees_ui.displayAllEntrees(data.entrees);
            addEvent();
        });
    });
}

function addEvent(){
    if(document.getElementById('home') !== null){
        document.getElementById('home').addEventListener('click', function(){
                getAllEntrees();
        });
    }
    if(document.getElementById('select') !== null){
        document.getElementById('select').addEventListener('change', async function(e){
            await serviceEntrees_ui.displayServiceEntrees(e.target.value);
            addEvent();
        });
    }
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

function getEntree(url){
    loader_default.loadEntree(url)
    .then(data => {
        data.json().then(async data => {
            await entree_ui.displayEntree(data.entree);
            addEvent();
        });
    });

}

getAllEntrees();