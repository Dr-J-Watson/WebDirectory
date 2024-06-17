import loader_default from './js/loader';
import entrees_ui from './js/entrees_ui';

function getEntrees(){
    loader_default.loadEntrees()
    .then(data => {
        entrees_ui.displayEntrees(data);
    });
}

getEntrees();