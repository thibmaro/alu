"git clone URL" dans le repertoire www de wamp ou "git pull" si le projet existe déjà pour récupérer 
les fichiers à jour sur le dépot distant.

Télécharger depuis cmd php storm dans le projet : composer install ou update

→ Créer le fichier .env.local à la racine du projet et reprendre la variable d’environnement DATABASE_URL du fichier .env. 
Renseigner la configuration locale de la BDD (DATABASE_URL=mysql://root:@127.0.0.1:3306/alumni).

→ Créer la base de données en tapant la commande : php bin/console doctrine:database:create

établir la migration : php bin/console doctrine:migrations:migrate