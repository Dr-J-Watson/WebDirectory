# WebDirectory API

Disponible sur l'url : http://docketu.iutnc.univ-lorraine.fr:64993 `+ routes`

Avec les routes posssible, suivantes :
### - '/api/services[/]'
    - route pour avoir la liste des services

### - '/api/entrees[/]'
    - route pour avoir la liste des entrees

### - '/api/entrees/search[/]'
    - route pour rechercher des entrees en fonction de leur nom et prenom grace au parametre `q` exemple : `/api/entrees/search?q=co` pour avoir les entrees avec un nom ou prenom contenant `co`

### - '/api/services/{id}/entrees[/]'
    - route pour avoir les entrees d'un service en fonction de son id

### - '/api/services/{id}/entrees/search[/]'
    - route pour avoir les entrees d'un service en fonction de son id et rechercher des entrees en fonction de leur nom et prenom grace au parametre `q` exemple : `/api/services/{id}/entrees/search?q=co` pour avoir les entrees avec un nom ou prenom contenant `co`

### - '/api/entrees/{id}[/]'
    - route pour avoir une entree en fonction de son id

Vous avez aussi la possibilité de trier tout les résultats      contenant des entrees en fonction de leur nom par ordre alphabetique croissant ou decroissant grace au parametre `sort` exemple : `/api/entrees?sort=nom-asc` ou `/api/entrees?sort=nom-desc`