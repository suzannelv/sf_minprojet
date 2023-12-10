# Projet Symfony - LOLanguages

## Introduction

Suite au projet précédent réalisé en PHP natif, j'ai décidé de refaire ce projet en utilisant le framework Symfony et la bibliothèque Bootstrap 5.

Dans ce projet, plusieurs fonctionnalités ont été implémentées :

### 1. Entités

L'entité `Course` est l'une des entités les plus importantes pour présenter les données aux utilisateurs. Elle est liée aux autres entités avec des relations `ManyToOne` (entités `Teacher`, `Level`, `Language`) et `ManyToMany` (`Tag`).

L'entité `User` possède deux types de rôles, `ROLE_USER` (par défaut) et `ROLE_ADMIN`. Cette partie sera expliquée dans la section de contrôle d'accès.

## 2. Controller

### 2.1 `Course`

Pour gérer les différentes classes, on doit utiliser le générateur (maker) pour créer des contrôleurs afin de communiquer avec les modèles et de rendre des vues sur le navigateur.

Dans le contrôleur `Course`, j'ai créé des pages pour afficher tous les cours, ainsi qu'une route pour accéder à la page présentant les détails d'un cours sélectionné selon son identifiant `{id}`.

### 2.2 User

### 2.3 Security

### 2.4 Registration

## 3. Fixtures

Une fois la base de données créée, j'ai utilisé le package de fixtures pour générer des fausses données plutôt que de saisir manuellement des données.

:::caution Respecter l'ordre
Comme l'entité `Course` est du côté **propriétaire** (qui détient les clés étrangères), il est nécessaire de mettre les autres classes avant la classe `Course`. Sinon, des cases vides apparaîtront pour les colonnes mappées (comme `language`, `teacher`, `level`) après l'exécution de `flush()`.
:::

## 4. Formulaires

Pour créer des formulaires d'inscription, j'ai utilisé le générateur (maker) : `registration-form` pour générer un formulaire qui intègre déjà des fonctionnalités pour vérifier l'e-mail, hacher les mots de passe, etc.

## 5. Event Subscriber

Sur la page des cours, j'ai créé une liste déroulante des langues. Si l'utilisateur choisit une langue, tous les cours correspondant à la langue sélectionnée seront affichés.

Pour réaliser cela, j'ai importé la classe `Environment` de Twig pour manipuler l'environnement Twig.

Dans la classe `DropDownLangSubscriber`, j'ai déclaré une constante sous forme de **tableau** qui contient les noms des routes écoutant cet événement (ici, uniquement la page des cours écoute cet événement, mais imaginons qu'il y ait d'autres pages voulant utiliser la même fonction, on peut ajouter d'autres routes).

Quand un événement Request est déclenché, la fonction `injectGlobalVariable` est exécutée. Si le nom de la route actuelle est dans la liste définie par la constante `Route`, toutes les langues sont récupérées dans `LanguageRepository` et injectées comme **variable globale** dans Twig.

## 6. EasyAdmin

Pour les opérations CRUD, seuls les utilisateurs ayant le rôle `ROLE_ADMIN` peuvent y accéder. Si un administrateur se connecte, un élément **Dashboard** s'affiche dans la navigation, sinon, il est invisible.

Sur la page `/admin`, il est possible de modifier toutes les données concernant les cours et les utilisateurs.

## 7. Contrôle d'accès

Sur la page d'accueil, tous les utilisateurs peuvent voir les cours, mais en cliquant sur un cours détaillé, ils sont redirigés directement vers la page de connexion, car elle est **réservée aux utilisateurs inscrits**.

```yaml
access_control:
    - { path: ^/admin, roles: ROLE_ADMIN }
    - { path: ^/course, roles: IS_AUTHENTICATED_FULLY }
```

Comme mentionné précédemment, l'accès à la page **Dashboard** est **réservé aux utilisateurs ayant le rôle administrateur**.
