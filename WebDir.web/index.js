import loader_default from './js/loader';
import allEntrees_ui from './js/allEntrees_ui';

function getEntrees(){
    loader_default.loadAllEntrees()
    .then(data => {
        data.json().then(async data => {
            await allEntrees_ui.displayAllEntrees(data.entrees);
        });
    });
}

getEntrees();