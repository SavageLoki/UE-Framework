## Exemple httpKernel

L'exemple pour le httpKernel consiste a dérouler au fur et à mesure le code pour lancer une appli

1 - Le but est de trouver la fonction f(x) = y ou f(request) = reponse  
C'est le handle de httpKernel qui représente cette fonction et c'est le controller qui a en charge de la mettre en oeuvre. 
La première étape sera de développer un controller dont les méthode vont renvoyer des instance de Response

2 - La méthode du controller peut-être déclanchée lorsque l'URI a été reconnue par une route. Cette association
est convertie en "callable" PHP qui sera insérer dans les arguments de l'objet Request.

3 - Inserer un listener avant l'utilisation du routing (qui est vide pour le momment) pour initialiser l'argument
_controller. Le listener comparera juste RequestURI de l'API Request pour la comparer à un chemin est 
mettre le bon callable en fonction

4 - Réécrire la détermination du bon controller (qui est pour le moment un simple if) en la définition de
deux routes. et du UrlMatch qui déclanche la reconnaissance des routes

5 - Export les routes dans un yaml, les définir en mode déclaratif et charger les routes à partir du fichier 
yaml.




pour cette exemple, lancer

    $ php -S 0.0.0.0:8000 -t public/src public/src/httpkernel.php
    
## Support UE Framework
La code cette branche accompagne le cours sur HttpKernel, l'inversion de contrôle etc.
Les sources se trouve dans ```public/src``` vous pouvez l'executer via votre navigateur en 
lançant le serveur de symfony

    $ bin/console server:start 0.0.0.0:8000
ou en lançant les scripts php directement avec l'interpréteur ou encore en utilisant 

    $ php -S 0.0.0.0:8000 -t public/src

Pour l'exemple avec le log, il ne faut pas démarrer le serveur en backround

    $ bin/console server:run 0.0.0.0:8000