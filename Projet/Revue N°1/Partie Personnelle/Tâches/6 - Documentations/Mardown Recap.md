<a id="LLM"></a>
<div align="center"> 

# ⚙️ Markdown - GTB ⚙️
</div>

---

<div align="center"> 

## 💻 Logiciels / Langages / Matériel 💻


[![Développement Web](https://img.shields.io/badge/HTML-CSS-yellow)](https://www.w3.org/) [![PHP SQL](https://img.shields.io/badge/PHP-MySQL-8A2BE2)](https://www.php.net/) ![JavaScript](https://img.shields.io/badge/JavaScript-Json-fd5000)


![Visual Studio Code](https://img.shields.io/badge/Visual%20Studio%20Code-2a52be) [![Arduino](https://img.shields.io/badge/Arduino-teal)](https://docs.arduino.cc/) ![Node JS](https://img.shields.io/badge/NodeJS-fg2400)


![GitHub git](https://img.shields.io/badge/GitHub-git-fd5800)
![GitLab git](https://img.shields.io/badge/GitLab-git-fd5800)
![Markdown](https://img.shields.io/badge/M%20⬇-191970)
</div>

---
<div align="center">

## 📋<cite><font color="#F2A900"> Table des matières </font></cite>📋

</div>

1. [Logiciels et supports](#LLM)
2. [Présentation](#PP)
3. [Liste des tâches](#CC)
4. [Architecture du Projet](#ARCHI)
5. [Autres Programmes](#AUTRES)
6. [Programmes BDD](#BDD)
7. [Fonctionnalités Attendues](#FA)
8. [Main.cpp](#MAINCPP)
9. [Liens Utiles](#LINKS)
---
<a id="PP"></a>

<div align="center"> 

## <cite><font color="#F2A900"> Présentation : </font></cite>

Ce projet présente la mise en place d'une Gestion Technique de Bâtiment. Il est composé de plusieurs parties : "Partie Réseau", "Partie LoRaWAN", "Partie Frontend" et "Partie Backend". Ces différentes parties sont toutes attribuées à des étudiants. Un cahier des charges, lié au projet et contenant les tâches ainsi que les besoins du client, a été rédigé afin d’organiser au maximum le travail en équipe et l'organisation de celle-ci pour mener à bien ce projet.

---
<a id="CC"></a>

## <cite><font color="#F2A900"> Tâches à accomplir : </font></cite>

| Tâche-3 (M.A.-B)| Liste des tâches à effectuer.               | Sous tâches.                                                               |
|-----------------|---------------------------------------------|----------------------------------------------------------------------------|
| Backend         | Configuration de l'environnement.           | Installer les applications VSCode & Node.js.                               |
|                 |                                             | Configurer les dépendances nécéssaires.                                    |
|                 | Conception de la base de données.           | Modéliser la base de données pour les bâtiments, capteurs et températures. |
|                 |                                             | Configurer la connexion à la base de données choisie.                      |
|                 | Développement du Backend.                   | Créer des endpoints pour gérer bâtiments, capteurs et températures.        |
|                 |                                             | Implémenter la logique métier.                                             |
|                 |                                             | Gestion de l'authentification.                                             |
|                 |                                             | Mettre en place un système d'authentification simple mais sécurisé.        |
|                 |                                             | Validation de l'obtention des données.                                     |
|                 | Intégration avec la base de données.        | Ecrire des requêtes SQL pour intéragir avec la base de données.            |
|                 | Réalisations des tests et des validations.  | Tester chaque Endpoint.                                                    |
|                 |                                             | Vérifier l'intégration avec le Frontend.                                   |
|                 |                                             | Réaliser un audit de sécurité.                                             |
|                 | Configuration des services.                 | Configuration d'Uptime Kuma & de NTOPNG.                                   |
|                 |                                             | Configuration du service Zabbix.                                           |
|                 |                                             | Configuration de la supervision avec Grafana.                              |
|                 | Rédaction d'une documentation complète.     | Réaliser un guide d'utilisation.                                           |
|                 |                                             | Rédiger des documentations professionnelles.                               |

---
<a id="ARCHI"></a>

## 🗂️ Architecture du Projet
</div>

```plaintext
📦Projet
 ┣ 📂V1
 ┃ ┣ 📂Codes
 ┃ ┃ ┣ 📂API
 ┃ ┃ ┣ 📂Autres
 ┃ ┃ ┃ ┗ 📜Markdown.md
 ┃ ┃ ┗ 📂BDD
 ┃ ┃ ┃ ┣ 📂Programmes_Utiles
 ┃ ┃ ┃ ┃ ┣ 📜Affichage.php
 ┃ ┃ ┃ ┃ ┣ 📜Get.php
 ┃ ┃ ┃ ┃ ┣ 📜Insert.php
 ┃ ┃ ┃ ┃ ┣ 📜Login.css
 ┃ ┃ ┃ ┃ ┣ 📜Login.php
 ┃ ┃ ┃ ┃ ┣ 📜PDOBDP.php
 ┃ ┃ ┃ ┃ ┣ 📜Redirection.php
 ┃ ┃ ┃ ┃ ┣ 📜Registration.css
 ┃ ┃ ┃ ┃ ┣ 📜Registration.php
 ┃ ┃ ┃ ┃ ┣ 📜SuppressionDB.php
 ┃ ┃ ┃ ┃ ┣ 📜SuppressionTable.php
 ┃ ┃ ┃ ┃ ┗ 📜config.php
 ┃ ┃ ┃ ┗ 📂SQL
 ┃ ┃ ┃ ┃ ┣ 📂Bibliothèque
 ┃ ┃ ┃ ┃ ┣ 📂Ecole
 ┃ ┃ ┃ ┃ ┣ 📂Gymnase
 ┃ ┃ ┃ ┃ ┣ 📂Mairie
 ┃ ┃ ┃ ┃ ┃ ┣ 📜connexions.sql
 ┃ ┃ ┃ ┃ ┃ ┣ 📜etats.sql
 ┃ ┃ ┃ ┃ ┃ ┣ 📜logs.sql
 ┃ ┃ ┃ ┃ ┃ ┣ 📜mairie.sql
 ┃ ┃ ┃ ┃ ┃ ┗ 📜variables.sql
 ┃ ┃ ┃ ┃ ┗ 📂SDF
 ┃ ┣ 📂Documents Projet
 ┃ ┃ ┣ 📂Revues
 ┃ ┃ ┃ ┗ 📜Revue N°1.pdf
 ┃ ┃ ┣ 📜01 Epreuve de projet.pdf
 ┃ ┃ ┣ 📜Adressage projet V6.drawio.png
 ┃ ┃ ┣ 📜Fiche présentation projet CIEL-E6-IR 2025 - GTB bâtiments Communaux - SMICA.pdf
 ┃ ┃ ┣ 📜GTB.pptx
 ┃ ┃ ┣ 📜Projet 2024 - GTB bâtiments communaux - SMICA.pdf
 ┃ ┃ ┣ 📜Schéma réseau GTB.png
 ┃ ┃ ┗ 📜projet_bts_ciel_carnus_2025_gtb.pdf
 ┃ ┗ 📂Partie Personnelle
 ┃ ┃ ┣ 📂Besoins du projet
 ┃ ┃ ┃ ┣ 📜Assemblage.txt
 ┃ ┃ ┃ ┣ 📜Fiche questions.txt
 ┃ ┃ ┃ ┣ 📜Gestion des tâches.png
 ┃ ┃ ┃ ┣ 📜Informations IU.txt
 ┃ ┃ ┃ ┣ 📜Organisation.txt
 ┃ ┃ ┃ ┣ 📜Revue N°1.txt
 ┃ ┃ ┃ ┣ 📜Solutions envisagées.txt
 ┃ ┃ ┃ ┣ 📜Thumbs.db
 ┃ ┃ ┃ ┗ 📜Tâches à réaliser.png
 ┃ ┃ ┣ 📂Diagrammes
 ┃ ┃ ┃ ┣ 📜Diagrammes d_exigences.png
 ┃ ┃ ┃ ┣ 📜GTB - Diagramme de blocs..png
 ┃ ┃ ┃ ┣ 📜GTB - Diagramme de cas..pdf
 ┃ ┃ ┃ ┣ 📜GTB - Diagramme de cas.png
 ┃ ┃ ┃ ┗ 📜Thumbs.db
 ┃ ┃ ┣ 📂Diapo
 ┃ ┃ ┃ ┣ 📜01.1 Epreuve de projet.pdf
 ┃ ┃ ┃ ┣ 📜01.2 Revue 1.pdf
 ┃ ┃ ┃ ┣ 📜Baie.jpg
 ┃ ┃ ┃ ┣ 📜Ecole.jpg
 ┃ ┃ ┃ ┣ 📜Logo BTS CIEL.png
 ┃ ┃ ┃ ┣ 📜Mairie.jpg
 ┃ ┃ ┃ ┣ 📜Serveurs.jpg
 ┃ ┃ ┃ ┣ 📜Thumbs.db
 ┃ ┃ ┃ ┗ 📜Travail.jpg
 ┃ ┃ ┣ 📂Documentations
 ┃ ┃ ┣ 📂Fiches Annexes
 ┃ ┃ ┣ 📂Tâches
 ┃ ┃ ┃ ┣ 📂1 - Configuration & Environnement
 ┃ ┃ ┃ ┃ ┣ 📜Dépendances installées_.docx
 ┃ ┃ ┃ ┃ ┗ 📜Installations logiciels_.docx
 ┃ ┃ ┃ ┣ 📂2 - Base de données
 ┃ ┃ ┃ ┣ 📂3 - Backend
 ┃ ┃ ┃ ┃ ┗ 📜Logique Métier
 ┃ ┃ ┃ ┣ 📂4 - Tests et Validations
 ┃ ┃ ┃ ┣ 📂5 - Supervision & Gestion
 ┃ ┃ ┃ ┗ 📂6 - Documentations
 ┃ ┃ ┃ ┃ ┗ 📜Guide d'utilisation.md
 ┃ ┃ ┗ 📜Thumbs.db
 ┗ 📂V2
 ┃ ┣ 📂Codes
 ┃ ┃ ┣ 📂API
 ┃ ┃ ┣ 📂Autres
 ┃ ┃ ┗ 📂BDD
 ┃ ┃ ┃ ┣ 📂Base de données V1
 ┃ ┃ ┃ ┣ 📂Base de données V2
 ┃ ┃ ┃ ┣ 📂SQL
 ┃ ┃ ┃ ┗ 📂Tables
 ┃ ┃ ┃ ┃ ┣ 📂Ecole
 ┃ ┃ ┃ ┃ ┣ 📂Gymnase
 ┃ ┃ ┃ ┃ ┗ 📂Mairie
 ┃ ┣ 📂Documents Projet
 ┃ ┗ 📂Partie Personnelle
 ┃ ┃ ┣ 📂Besoins du projet
 ┃ ┃ ┃ ┗ 📜Thumbs.db
 ┃ ┃ ┣ 📂Diagrammes
 ┃ ┃ ┃ ┗ 📜Thumbs.db
 ┃ ┃ ┣ 📂Diapo
 ┃ ┃ ┃ ┗ 📜Thumbs.db
 ┃ ┃ ┣ 📂Documentations
 ┃ ┃ ┣ 📂Fiches Annexes
 ┃ ┃ ┣ 📂Tâches
 ┃ ┃ ┃ ┣ 📂1 - Configuration & Environnement
 ┃ ┃ ┃ ┣ 📂2 - Base de données
 ┃ ┃ ┃ ┣ 📂3 - Backend
 ┃ ┃ ┃ ┣ 📂4 - Tests et Validations
 ┃ ┃ ┃ ┗ 📂5 - Supervision & Gestion
 ┃ ┃ ┗ 📜Thumbs.db
```

<a id="AUTRES"></a>

## 🗂️ Programmes BDD

```plaintext

```

<a id="BDD"></a>

## 🗂️ API's

```plaintext

```

```plaintext

```
---

<a id="FA"></a>

## 🔧 Fonctionnalités Attendues 🔧
</div>

### 1. Configuration de l'environnement.
- La réalisation des programmes et du projet doit être réalisée avec les applications Visual Studio Code et Node.js ainsi que la configuration des dépendances pour réaliser le projet.

### 2. Conception de l abase de données.
- Des chémas de modélisation de la base de données doivent être réalisées modélisant les bâtiments et capteurs.
- La base de données doit être configurée de manière à réaliser le projet.

### 3. Développement du Bakcned.
- La partie Backend doit comprendre des endpoints permettant le transfert des données ainsi que la gestion des batiments et capteurs. Une actualisation automatique doit être réalisée.
- La logique métier doit être implémentée dans le guide d'utilisation. Elle sera liée à la partie Backend afin de décrire en fonction des permissions dont dispose l'utilisateur, des actions et des règles qui doivent être respectées.
- Une authentification utilisateur complète et sécurisée doit aussi être implémentée et liée à la base de données afin de sécuriser l'ensemble de l'application.
- La validation consiste en l'obtention et l'affichage des données via l'API sur la page du client afin qu'il puisse observer en temps réel les données du bâtiment auquel il est attitré.

### 4. Intégration avec la base de données.
- Lors des différentes actions en lien avec la base de données, des requêtes SQL doivent être émisent pour effectuées le transfert des données.

### 5. Tests et Validations.
- Lors des tests, chaque endpoint doit être testé pour assurer le bon fonctionnement de l'application.
- L'intégration ave c le Frontend doit aussi être méthodiquement réalisée car l'utilisateur ne doit pas pouvour accéder au Backend via le Frontend ni de pouvoir réaliser des actions auquel il ne doit pas avoir accès.
- La réalisation d'un audit de sécurité ets primordial pour vérifier la sécurité de l'application, des communications, des systèmes, etc.

### 6. Configuration des services.
- Les services Uptime Kuma et NTOPNG doivent être configurer pour réaliser la surveillance et le traffic du réseau. Cel apermet de vérifier si les systèmes fonctionnent correctement ou alors si une anomalie apparait dans le traffic réseau.
- L'installation des services dans un docker unique permet de centraliser tous les services en un seul point. Ils sont donc plus simple à gérer mais cela rend plus impactant un problème survenant sur le docker.
- L'installation du service Zabbix permet à l'utilisateur de surveiller l'état des serveurs dont la base de données.
- Pour finir, le service Grafana nous permet de superviser tous les systèmes mais aussi les différentes variables pouvant transitées ou provenir du réseau.

### 7. Documentations.
- La rédaction de documents professionnnels est très importante. Elle permet de tenir compote du travail accomplis mais aussi de fournir au client un support pour l'utiliser. Il peut s'agir de documentation système ou alors d'un guide d'utilisation par exemple.

---
<a id="LINKS"></a>
+
<div align="center"> 

## 🔗 Liens Utiles 🔗

</div>

- [Documentations systèmes](https://drive.google.com/drive/folders/1H58if5spBOuIf7rgikKWL6RQrw85gEN-?usp=sharing)
- [GITHUB](https://github.com/MatheoAB)
- [DRIVE](https://drive.google.com/drive/folders/1V1ERJhE6TJG8AdwI1S_2QSyIhg0Lucuy?usp=sharing)
---

**Projet : Gestion Technique de Bâtiments**  
Créé par : [Mathéo ALBOUY-BENALIA](https://drive.google.com/drive/folders/1EK4s1p8XXbPVbmiZznWmid2rBhrHbWuR?usp=sharing)  
Date : 18 mars 2025  
Licence : [BTS CIEL 2ème](https://carnus.fr)  

---