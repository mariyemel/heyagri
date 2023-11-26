# HeyAgri 

  

## Vue d'ensemble 

HeyAgri est une application web dynamique conçue pour connecter les utilisateurs aux activités de jardinage et d'agriculture. Elle se présente comme une plateforme interactive et éducative sur le jardinage, offrant des informations personnalisées sur le jardinage, des recommandations pour l'optimisation de la croissance, et une base de données riche et navigable d'informations sur les plantes. Conçue pour être intuitive et engageante. 

  

## Fonctionnalités 

- Conseils de jardinage personnalisés en fonction de la sélection spécifique de plantes. 

- Une base de données étendue d'informations sur les plantes, accessible et compréhensible pour tous les niveaux d'utilisateurs. 

- Outils pour la planification de jardins, en tenant compte des besoins en sol et en lumière. 

- Engagement communautaire et partage d'expériences et de conseils. 

- Promotion du jardinage urbain et contribution au bien-être écologique et à la biodiversité. 

  

## Nomination 

"HeyAgri" combine un ton amical et accessible avec une référence claire à l'agriculture, aidant au branding, à la mémorabilité et au référencement naturel (SEO). 

 ## Utilisation de bonnes pratiques 

Nous avons essayé de programmer notre code en suivant les instructions de clean code pour avoir un code simple et facile. 

## Hachage de mots de passe 

Nous avons appliqué un hachage robuste côté serveur avant de stocker les mots de passe dans notre base de données d’une manière sécurisée. 

 

## Développement 

L'application est construite en utilisant PHP, MySQL pour la gestion des données, HTML, CSS pour le style et JavaScript pour les éléments interactifs. XAMPP a été utilisé pour créer un environnement de serveur local robuste pour le développement et les tests. 

  

## Principes du Code Propre 

Le code est développé en suivant les principes de simplicité, de concision, de modularité, de testabilité et de documentation, assurant une compréhension et une maintenance faciles. 

  

## Gestion de Projet 

Nous avons employé des diagrammes de Gantt pour l'organisation des tâches et le suivi des progrès, assurant un processus de développement structuré et en temps voulu. 

  

## Conception Fonctionnelle 

HeyAgri présente une structure hiérarchique, permettant aux utilisateurs de naviguer intuitivement de la page d'accueil vers des sections spécifiques, des sous-sections et des pages individuelles, assurant une expérience utilisateur cohérente et efficace. 

  

## Environnements de Développement 

- Configuration du serveur de développement local en utilisant XAMPP. 

- Gestion du contrôle de version et développement collaboratif géré via GitHub. 

  

## Développement Backend 

MySQL est utilisé pour un système de gestion de données fiable et efficace, avec un schéma conçu pour l'optimisation et la normalisation. 

  

## Conception Frontend 

HTML5 est utilisé pour la structure des pages, avec un design responsif pour assurer la compatibilité avec une large gamme d'appareils. 

  

## Pour Commencer 

Clonez le dépôt et suivez les instructions de configuration pour démarrer le serveur de développement local qui est sur le port 3307. 

## Système de build 

Dans notre projet, nous avons insérés package de Json, Readme et composer pour faire le test unitaire que nous avons mentionnés sur notre rapport. 

## Système de CVS 

Nous avons utilisé un système de contrôle de version (VCS) qui est Git afin d’initialiser notre projet et ajouter les modifications.

## Patterns de conception

Application de différents patterns de conception comme le Module Pattern, la Factory Function, la Configuration Object, le Callback Pattern, et l'utilisation judicieuse de l'API DOM reflète une approche méthodique. Ces choix de conception assurent une structure modulaire, une encapsulation efficace, et une gestion flexible des fonctionnalités.

- Module Pattern : La fonction MultiSelectTag est encapsulée dans une fonction auto-exécutante, instaurant ainsi un contexte privé pour les variables et fonctions, écartant ainsi tout impact sur l'espace global.

- Factory Function : La fonction MultiSelectTag agit en tant que factory function, instiguant la création d'une instance du composant multi-tags. Elle prend en considération un élément cible (el) et des options personnalisées.

- Configuration Object : L'utilisation de l'objet customs en tant qu'objet de configuration offre une flexibilité accrue pour ajuster le comportement du composant de manière personnalisée.

- Callback Pattern : La fonction customs.onChange est exploitée en tant que callback personnalisée, déclenchée lors de modifications dans la sélection, permettant ainsi une extensibilité à travers la personnalisation des actions.

- Encapsulation : La logique du composant est enfermée à l'intérieur de la fonction MultiSelectTag, restreignant la portée des variables internes à cette fonction, contribuant ainsi à la cohérence et à la lisibilité du code.

- Utilisation de l'API DOM : Les fonctions de l'API DOM sont utilisées pour créer et manipuler les éléments HTML, conformément aux bonnes pratiques de manipulation du DOM.
