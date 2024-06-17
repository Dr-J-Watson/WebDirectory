import loader from "./loader";

async function displayEntrees(data){
    console.log(data);
    const container = document.getElementById('main');
    const templateSource = document.getElementById('listEntreeTemplate').innerHTML;
    const template = Handlebars.compile(templateSource);
    const html = template(data);
    container.innerHTML = html;
}

export default { displayEntrees };