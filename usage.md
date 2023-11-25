# Guide d'utilisation

## 1. Sign-In (sign-in.php)

Cette page permet à l'utilisateur de se connecter. Elle inclut un formulaire pour saisir le nom d'utilisateur (pseudo) et le mot de passe.

**Fonctionnalités clés :**
- Utilisation de PHP pour vérifier les informations d'identification.
- Utilisation de sessions pour stocker les informations de l'utilisateur connecté.

## 2. Sign-Up (sign-up.php)

Cette page permet à un nouvel utilisateur de s'inscrire en fournissant un nom d'utilisateur et un mot de passe.

**Fonctionnalités clés :**
- Utilisation de PHP pour vérifier si le nom d'utilisateur est déjà pris.
- Hashage du mot de passe avant de le stocker dans la base de données.
- Utilisation de sessions pour connecter automatiquement l'utilisateur après l'inscription.

## 3. Services (services.php)

Page principale des services. L'utilisateur doit être connecté (utilisation de sessions) pour accéder à cette page.

**Fonctionnalités clés :**
- Affiche différents services liés à la gestion d'un jardin urbain.
- Utilisation de PHP pour rediriger les utilisateurs non connectés vers la page de connexion.

## 4. Watering Guide (watering.php)

Page présentant un guide d'arrosage pour les plantes sélectionnées.

**Fonctionnalités clés :**
- Utilisation de JavaScript pour une sélection multi-tags.
- Affichage des informations d'arrosage pour les plantes sélectionnées.
- Interaction avec la base de données MySQL pour récupérer les informations.

## 5. Base de données et Configuration

- `db_connection.php` et `Config.php` : Contiennent les informations de connexion à la base de données et les paramètres de configuration.
- SQL Database : Utilisation de MySQL pour stocker les informations des utilisateurs, des plantes et des services.

## 6. Scripts JavaScript

- `Multitag.js` : Fichier JavaScript pour la fonctionnalité de sélection multi-tags.
- `menu.js` : Fichier JavaScript pour la fonctionnalité de bascule du menu responsive.

## 7. Styles CSS

- Dossier `style/` : Contient des fichiers CSS pour la mise en page et le style des différentes pages.

## 8. Autres Remarques Générales

- Utilisation de PDO pour la connexion à la base de données.
- Utilisation de sessions pour gérer l'authentification des utilisateurs.
- Utilisation de requêtes préparées pour éviter les injections SQL.
- Utilisation de l'API FontAwesome pour les icônes.
- Utilisation de HTML, CSS et JavaScript pour la mise en page et l'interaction utilisateur.
