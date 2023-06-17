# MyGiftBox
Projet MyGiftBox du semestre 4

# Groupe
- Brindejonc Timothée
- Steelandt Jules
- Bernardet Nicolas

# Installation
Pour installer le projet en local, vous devez générer les dossiers vendor dans api et dans appli et lancer le composer du docker. 

1. Rendez-vous dans ses deux dossiers, puis dans leur src respectifs.
2. Pour chacun des deux, taper "compsoser install", le vendor se génèrera.
3. Une fois fait, vous avez besoin de créer un .env à la racine pour les utilisateurs de la base de donnée, voici un template du .env :

MYSQL_ROOT_PASSWORD=motDePasse
DB_USER=user
DB_PASSWORD=user

4. Une fois le .env créer, vous devez créer un fichier gift.db.conf.ini à mettre dans /appli/src/conf et dans /api/src/conf pour que notre application communique avec notre base de donnée. Voici un template du gift.db.conf.ini

driver=mysql
username=root
password=motDePasse
host=gift.db
database=nomBase
charset=utf8
collation=utf8_unicode_ci

Pour password le mot de passe doit être le même que pour le "MYSQL_ROOT_PASSWORD" du .env, vous pouvez modifier le nom de la database.

5. Une fois tous les fichiers créer et à leur place dans l'architecture, vous pouvez démarrer les conteneurs docker avec "docker compose up -d" dans la racine du projet.

6. Si les conteneurs sont démarrés, vous pouvez accéder à la base de donnée sur le lien suivant : localhost:17002. Connectez-vous, créer une base de données du même nom que dans le gift.db.conf.ini "database" et importer le SQL fourni dans le projet.

7. L'application est maintenant fonctionnelle sur le lien suivant : localhost:17000. L'api est disponible sur le lien suivant : localost:17003/api/. L'api est accessible avec les routes suivantes : /api/prestations, /api/catégories, /api/catégories/[id_cat]/prestations et /api/coffrets/[id].

Un utilisateur déjà inscrit de test est disponible, avec l'email "user@mail.com" et "user1" en mot de passe.

# Fonctionnalités
## 1 Afficher la liste des prestations
✅ Fonctionnalité réalisée ensemble en cours.
## 2 Afficher le détail d'une prestation
✅ Fonctionnalité réalisée ensemble en cours.
## 3 Liste de prestations par catégories
✅ Fonctionnalité réalisée ensemble en cours.
## 4 Liste de catégories
✅ Fonctionnalité réalisée ensemble en cours.
## 5 Tri par prix
✅ Réalisée par Timothée Brindejonc
## 6 Création d'un coffret vide
✅ Fonctionnalité réalisée ensemble en cours.
## 7 Ajout de prestations dans le coffret
✅ Fonctionnalité réalisée par Jules Steelandt et Timothée Brindejonc.
## 8 Affichage d'un coffret
✅ Réalisée par Timothée Brindejonc
## 9 Validation d'un coffret
✅ Réalisée par Timothée Brindejonc
## 10 Paiement d'un coffret
✅ Réalisée par Timothée Brindejonc
## 11 Modification d'un coffret : suppression de prestations
✅ Réalisée par Jules Steelandt
## 12 Modification d'un coffret : modification des quantités
✅ Réalisée par Jules Steelandt
## 13 Génération de l'URL d'accès
✅ Réalisée par Nicolas Bernardet
## 14 Accès au coffret
✅ Réalisée par Nicolas Bernardet
## 15 Signin
✅ Réalisée par Nicolas Bernardet
## 16 Register
✅ Réalisée par Nicolas Bernardet
## 17 Accéder à ses coffrets
✅ Réalisée par Jules Steelandt
## 18 Afficher les box prédéfinies
✅ Réalisée par Nicolas Bernardet
## 19 Créer un coffret prérempli à partir d'une box
✅ Réalisée par Timothée Brindejonc
## 20 Créer un coffret prérempli à partir d'une box affichée
✅ Réalisée par Nicolas Bernardet
## 21 Api : liste des prestations
✅ Réalisée par Jules Steelandt
## 22 Api : liste des catégories
✅ Réalisée par Jules Steelandt
## 23 Api : liste des prestations d'une catégorie
✅ Réalisée par Jules Steelandt
## 24 Api : accès à un coffret
✅ Réalisée par Jules Steelandt
