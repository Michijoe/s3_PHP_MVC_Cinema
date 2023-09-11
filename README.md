# Cinéma Méliès

<!-- TABLE OF CONTENTS -->
<details>
  <summary>🏁 Sommaire</summary>
  <ol>
    <li><a href="#-intro">Intro</a></li>
    <li><a href="#-quickstart">Quickstart</a></li>
    <li><a href="#-features">Features</a></li>
    <li><a href="#-built-with">Built with</a></li>
  </ol>
</details>

## ⚡ Intro

Site web d'un cinéma utilisant une structure MVC, la programmation orientée objet (POO) et une base de données SQL. 
- Affichage des films à l'affiche et prochainement en salle. 
- Interface d'administration sécurisée.

Templates construits avec Twig.
Classe singleton pour instanciation unique d'un objet PDO.
Programmation POO pour gérer les accès PDO à la base de données.

## 🚀 Quickstart

L'environnement de développement instaure la date du jour au 25/10/2021.

L'interface d'administration exploite 4 profils utilisateurs : admin, correcteur, éditeur, client.
- Client (défaut): accède uniquement au site frontend ;
- Correcteur : modifie uniquement toutes les entités autres qu'utilisateur ;
- Editeur : gère complètement toutes les entités sauf l'entité utilisateur ;
- Administrateur : gère complètement toutes les entités.

## 🎯 Features

1. Page de consultation des films à l'affiche : page d'accueil, films qui ont le statut visible et qui ont des séances dans les 7 prochains jours.
2. Page de consultation des films diffusés prochainement : films qui ont le statut visible et qui n'ont pas de séances pendant les 7 jours glissants à compter de la date du jour.
3. Page de consultation d'un film : toutes les informations d'un film avec bande-annonce et séances pour les 7 prochains jours si disponibles. 
4. Interface administrateur : formulaire de création de compte, formulaire d'authentification et gestion des utilisateurs selon le profil utilisateur.

## 🤖 Built With
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white) ![MySQL](https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white) ![HTML](https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white) ![CSS](https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white) ![JS](https://img.shields.io/badge/JavaScript-323330?style=for-the-badge&logo=javascript&logoColor=F7DF1E)

## 🌐 Screenshots

![Home page](./screenshot.png)