import Handlebars from "handlebars";
import conf from "./config.js";

async function displayServiceEntrees(url) {
    const container = document.getElementById("main");
    const templateSource = document.getElementById("listEntreeTemplate").innerHTML;
    const template = Handlebars.compile(templateSource);
    let data = await fetch(conf.url + url).then(data => data.json());
    let services = await fetch(conf.url + '/api/services').then(data => data.json());
    const html = template({entrees : data.entrees, services : services.services, tri : data.service});
    container.innerHTML = html;
}

export default { displayServiceEntrees };