

async function displayEntree(data){
    const container = document.getElementById('main');
    const templateSource = document.getElementById('entreeTemplate').innerHTML;
    const template = Handlebars.compile(templateSource);
    const html = template(data);
    container.innerHTML = html;
}

export default { displayEntree };