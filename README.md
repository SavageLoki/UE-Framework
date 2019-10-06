## Support UE Framework
La code cette branche accompagne le cours sur HttpKernel, l'inversion de contrôle etc.
Les sources se trouve dans ```public/src``` vous pouvez l'executer via votre navigateur en 
lançant le serveur de symfony

    $ bin/console server:start 0.0.0.0:8000
ou en lançant les scripts php directement avec l'interpréteur ou encore en utilisant 

    $ php -S 0.0.0.0:8000 -t public/src

Pour l'exemple avec le log, il ne faut pas démarrer le serveur en backround

    $ bin/console server:run 0.0.0.0:8000