# PHARMA-GEST

Ce projet est une application de gestion de pharmacie développée avec Laravel. L'application permet de gérer les produits pharmaceutiques, les commandes, les clients, etc.

## Prérequis

Avant de commencer, assurez-vous d'avoir installé les éléments suivants sur votre machine :

- PHP
- Composer
- Laravel CLI
- MySQL

## Installation

1. Clonez ce dépôt sur votre machine :


git clone https://github.com/nabilettihadi/PHARMA-GEST.git

### Accédez au répertoire du projet :



cd PHARMA-GEST

### Installez les dépendances PHP avec Composer :


composer install

### Copiez le fichier .env.example et renommez-le en .env :



cp .env.example .env

### Générez la clé d'application Laravel :



php artisan key:generate

### Configurez votre base de données dans le fichier .env :



DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nom_de_votre_base_de_donnees
DB_USERNAME=votre_nom_utilisateur
DB_PASSWORD=votre_mot_de_passe

### Exécutez les migrations pour créer les tables de base de données :



php artisan migrate

### Lancez le serveur de développement :



    php artisan serve

Accédez à l'application dans votre navigateur à l'adresse http://localhost:8000.

## Fonctionnalités

    Gestion des produits pharmaceutiques : ajouter, modifier, supprimer des produits.
    Gestion des commandes : passer des commandes, confirmer les commandes, afficher l'historique des commandes.
    Gestion des clients : Supprimer un client, afficher les informations des clients existants.
    Gestion des pharmacien :Supprimer un pharmacien, afficher les informations des pharmaciens existants.
    Authentification : système d'authentification pour gérer les accès des utilisateurs.

## Technologies Utilisées

    Laravel : Framework PHP pour le développement web.
    MySQL : Système de gestion de base de données relationnelle.
    HTML, CSS, JavaScript, Ajax : Technologies front-end pour l'interface utilisateur.
    Tailwind : Framework CSS pour le design et la mise en page.

## Auteur

Ce projet a été créé par Votre Nom.

## Contribuer

Les contributions sont les bienvenues ! N'hésitez pas à ouvrir une issue pour signaler un bug, proposer une amélioration ou soumettre une demande de fonctionnalité.