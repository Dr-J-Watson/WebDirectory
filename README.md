# WebDirectory

## Elèves :

- [Clément BRITO | TyrYoxan](https://github.com/tyryoxan)
- [Paul BRUSON | Dr-J-Watson](https://github.com/Dr-J-Watson)
- [Lenny COLSON | Okiles](https://github.com/okiles)
- [Vincent GEORGES | GeorgesVincent](https://github.com/georgesvincent)

## Installation :
- Cloner le repository

- Mettre en place le fichier sql.env au niveau de ce readme en vous basant sur le fichier sql.env.temp 
    - Valeurs utilisés pour le projet : 
    ```
        MYSQL_ROOT_PASSWORD=pBcBlCvG
        MYSQL_DATABASE=webdir
        MYSQL_USER=webdir
        MYSQL_PASSWORD=pBcBlCvG
    ```

- Lancer la commande `docker compose up -d` pour lancer les containers

- Lancer la commande `docker exec -it [nom_du_container_api] /bin/bash` puis faites un `composer install` pour installer les dépendances

- Refaire la même chose pour le container appli

- Pour la partie web, il faut :
    - Lancer la commande `docker exec -it [nom_du_container_web] /bin/bash` puis ce rendre dans le dossier `/var/www/html` avec la commande `cd /var/www/html`
    - Faire un `apt-get update & upgrade -y`
    - Faire la commande `apt-get install -y npm nodejs`
    - Faire un `npm install`
    - Et pour finir `npm run build`

## Utilisation :

- Vous accedez à la base de donnée via phpmyadmin sur l'url : http://docketu.iutnc.univ-lorraine.fr:64991/ avec les identifiants suivants :
    - `user: webdir` ou `root`
    - `password: pBcBlCvG`

- Vous trouverez les détails de chaque partie du projet dans les README.md de chaque partie

## Commentaires :

- En ce qui concernent les diferents git, nous avons tout d'abord commencé par un git commun pour tout le monde avec un dossier par partie du projet `WebDir.core` avec a l'intérieur les dossiers `api` et `appli` puis `WebDir.web` et `WebDir.app` et comme nous avons chacun travaillé sur une partie du projet, nous n'avons pas trouvé utile de mettre en place des branches.
 Par la suite nous avons tout de même mis en place 3 git différents pour chaque partie du projet `WebDir.core`, `WebDir.web` et `WebDir.app` pour pouvoir clone les parties du projet indépendamment mais comme certains fichier sont communs a plusieurs parties du projet, nous avons continué a travailler sur le git commun pour éviter les problèmes.