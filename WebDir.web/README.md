# WebDirectory WEB

Disponible sur l'url : http://docketu.iutnc.univ-lorraine.fr:64994/

## Elèves :

- [Clément BRITO | TyrYoxan](https://github.com/tyryoxan)
- [Paul BRUSON | Dr-J-Watson](https://github.com/Dr-J-Watson)
- [Lenny COLSON | Okiles](https://github.com/okiles)
- [Vincent GEORGES | GeorgesVincent](https://github.com/georgesvincent)

## Installation :

Après avoir suivi étapes d'installation pour le docker compose sont faites, pour faire fonctionner le WebDir.web, il faut :

- Lancer la commande `docker exec -it [nom_du_container_web] /bin/bash` puis ce rendre dans le dossier `/var/www/html` avec la commande `cd /var/www/html`

- Faire un `apt-get update & upgrade -y`

- Faire la commande `apt-get install -y npm nodejs`

- Faire un `npm install`

- Et pour finir `npm run build`


