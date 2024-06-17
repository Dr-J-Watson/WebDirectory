import Handlebars from 'handlebars';

async function displayAllEntrees(data){
    const container = document.getElementById('main');
    const templateSource = document.getElementById('listEntreeTemplate').innerHTML;
    const template = Handlebars.compile(templateSource);
    const html = template({entrees : data});
    container.innerHTML = html;
}

export default { displayAllEntrees };