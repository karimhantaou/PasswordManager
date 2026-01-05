# 🔐 Password Manager

## 📌 Description

**Password Manager** est une application web permettant de gérer de manière sécurisée des comptes et mots de passe.
Elle offre la possibilité de stocker, organiser et protéger des informations sensibles grâce au **hachage** et au **chiffrement** des données.

Les utilisateurs peuvent :

* gérer leurs comptes (identifiant, mot de passe, autres données)
* classer leurs comptes par catégories personnalisées
* générer des mots de passe robustes
* rechercher et trier rapidement leurs comptes

Toutes les données sensibles sont sécurisées et stockées dans une base de données **MySQL**.

![pm](https://github.com/user-attachments/assets/aff99489-cead-4ada-a83d-d80195105727)

---

## 🧠 Contexte du projet

Ce projet est né de la volonté de **centraliser et sécuriser mes informations sensibles** sans dépendre d’applications tierces.

Une première version a été développée :

* en **Python** pour sa simplicité,
* puis en **C++** pour ses performances,
* avant d’intégrer **Qt** pour une interface graphique plus avancée.

Ces versions étant limitées à un usage local, j’ai ensuite opté pour une **application web**, accessible depuis n’importe quel appareil connecté à Internet.

L’architecture a été entièrement repensée autour du **modèle MVC**, avec un fort accent mis sur :

* la sécurité (chiffrement, hachage),
* la maintenabilité,
* et les performances.

---

## 🎯 Objectifs du projet

* 🔐 **Sécurisation de l’accès**
  Page de connexion pour accéder à l’application

* 🗄️ **Stockage des données**
  Gestion des comptes (nom, identifiant, mot de passe, données associées)

* 🛡️ **Sécurité des données**

  * Mots de passe hashés
  * Autres données chiffrées

* 🔎 **Recherche rapide**
  Barre de recherche pour retrouver facilement un compte

* 📂 **Organisation**
  Trier et classer les comptes par catégorie

* 👤 **Espace administrateur**
  Gestion des utilisateurs depuis un espace dédié

* 🔑 **Générateur de mot de passe**
  Génération aléatoire de mots de passe robustes

---

## 🛠️ Technologies utilisées

* **Back-end :** PHP (architecture MVC)
* **Front-end :** HTML, CSS, JavaScript
* **Base de données :** MySQL
* **Gestion des dépendances :** Composer
* **Routing :** Système interne MVC
* **Sécurité :** Hashage et chiffrement des mots de passe et des données sensibles

---

## ⚙️ Installation et configuration

1. **Cloner le projet**

```bash
git clone "https://github.com/karimhantaou/PasswordManager.git"
cd PasswordManager
```

2. **Installer les dépendances avec Composer**

```bash
composer install
```

3. **Créer le fichier `.env` à la racine du projet**

```env
DB_HOST=host
DB_NAME=name
DB_USER=username
DB_PASSWORD=password
KEY=secret_key
```

4. **Importer une base de données MySQL**

5. **Démarrer votre serveur local**

6. **Accéder à l’application**

## 📝 Notes

* L’application est développée pour être **extensible** et maintenable grâce à l’architecture MVC.
* Toutes les données sensibles sont protégées et le projet suit les bonnes pratiques de sécurité.
