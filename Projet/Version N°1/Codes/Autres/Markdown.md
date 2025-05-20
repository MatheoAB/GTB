<a id="LLM"></a>
<div align="center"> 

# 🛜 Markdown - Partie Backend 🛜
</div>

---

<div align="center"> 

## 💻 Logiciels / Langages / Matériel 💻


[![PHP SQL](https://img.shields.io/badge/PHP-MySQL-8A2BE2)](https://www.php.net/) [![JavaScript MongoDB](https://img.shields.io/badge/JavaScript-Node.js%20-FFD700)](https://developer.mozilla.org/fr/docs/Web/JavaScript)

![Visual Studio Code](https://img.shields.io/badge/Visual%20Studio%20Code-2a52be) [![C++ Arduino](https://img.shields.io/badge/C++-Arduino-teal)](https://docs.arduino.cc/) 

![GitHub git](https://img.shields.io/badge/GitHub-git-fd5800)
![Markdown](https://img.shields.io/badge/M%20⬇-191970)
</div>

---
<div align="center"> 

## 📋 Table des matières 📋

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

Le projet est mené dans le cadre du BTS CIEL (Cybersécurité, Informatique et Réseaux) option A : Valorisation de la donnée et cybersécurité, pour la session 2025. Il est réalisé en partenariat avec le Syndicat Mixte Ouvert (SMICA), situé à Rodez.

L’objectif principal est de développer une solution de Gestion Technique du Bâtiment (GTB) destinée aux collectivités adhérentes du SMICA, permettant un suivi intelligent des bâtiments communaux grâce à des capteurs connectés en LoRaWan.
<a id="CC"></a>

## <cite><font color="#F2A900"> Tâches à accomplir : </font></cite>


Dans ce projet, ma mission principale est de développer le backend et d’assurer la sécurisation des données. Je commence par préparer mon environnement de travail en installant Node.js et toutes les dépendances nécessaires. Ensuite, je m’attaque à la conception de la base de données, qui va stocker toutes les informations sur les bâtiments, les capteurs et les relevés de données.

Une fois la base prête, je développe les API qui permettront de gérer ces données : ajout, modification, suppression et récupération des informations. Il est essentiel que ces API soient performantes et sécurisées. C’est pourquoi je mets en place un système d’authentification robuste pour s’assurer que seules les personnes autorisées puissent accéder aux données.

Je travaille aussi sur l’intégration avec le frontend, pour que les données s’affichent correctement sur l’interface utilisateur. À cette étape, je teste et ajuste mes endpoints pour garantir une communication fluide entre le serveur et l’application web.

Ensuite, je configure des outils de supervision comme Zabbix, Grafana et Uptime Kuma pour surveiller l’état du système en temps réel. Cela permet de détecter rapidement toute anomalie et d’améliorer la stabilité du service.

Enfin, je rédige une documentation technique et un guide utilisateur pour faciliter la prise en main du backend. L’objectif est que les futurs développeurs et les techniciens puissent comprendre facilement le fonctionnement du système et assurer sa maintenance.

Avec tout ce travail, je m’assure que les données des bâtiments communaux sont bien gérées, sécurisées et accessibles aux utilisateurs du projet.

|Tâche 3 | Backend & Sécurisation	Fonctions à développer et tâches à effectuer|
|-------------- |:----------------------------------------|
|𝗖𝗼𝗻𝗳𝗶𝗴𝘂𝗿𝗮𝘁𝗶𝗼𝗻 𝗱𝗲 𝗹’𝗲𝗻𝘃𝗶𝗿𝗼𝗻𝗻𝗲𝗺𝗲𝗻𝘁|	Installation de Node.js et des dépendances nécessaires|
|𝗕𝗮𝘀𝗲 𝗱𝗲 𝗱𝗼𝗻𝗻𝗲́𝗲𝘀|	Conception et modélisation de la base de données pour les bâtiments, capteurs et relevés|
||Configuration de la connexion à la base de données|
|𝗗𝗲́𝘃𝗲𝗹𝗼𝗽𝗽𝗲𝗺𝗲𝗻𝘁 𝗱𝘂 𝗯𝗮𝗰𝗸𝗲𝗻𝗱|	Création des API pour gérer les bâtiments, capteurs et relevés de données|
||Implémentation de la logique métier et des traitements des données|
|𝗦𝗲́𝗰𝘂𝗿𝗶𝘀𝗮𝘁𝗶𝗼𝗻 𝗱𝗲𝘀 𝗮𝗰𝗰𝗲̀𝘀|	Mise en place d’un système d’authentification sécurisé|
||Gestion des autorisations et droits d’accès|
|𝗜𝗻𝘁𝗲́𝗴𝗿𝗮𝘁𝗶𝗼𝗻 𝗮𝘃𝗲𝗰 𝗹𝗲 𝗳𝗿𝗼𝗻𝘁𝗲𝗻𝗱|	Mise en place des endpoints pour communiquer avec l’interface utilisateur|
||Tests et validation des échanges de données|
|𝗦𝘂𝗽𝗲𝗿𝘃𝗶𝘀𝗶𝗼𝗻 𝗲𝘁 𝘀𝘂𝗿𝘃𝗲𝗶𝗹𝗹𝗮𝗻𝗰𝗲|	Configuration de Zabbix, Grafana et Uptime Kuma pour la surveillance du système|
|𝗗𝗼𝗰𝘂𝗺𝗲𝗻𝘁𝗮𝘁𝗶𝗼𝗻|	Rédaction d’un guide technique et d’un guide utilisateur|
||Rédaction d’un rapport détaillant les choix techniques et la mise en œuvre|

---

<a id="ARCHI"></a>

## 🗂️ Architecture du Projet
</div>

```plaintext
📦 Projet_GTB
 ├── 📂 .pio
 ├── 📂 .vscode
 ├── 📂 include
 │    └── README
 ├── 📂 lib
 │    └── 
 ├── 📂 src
 │    └── main.cpp
 ├── .gitignore
 ├── platformio.ini
 └── Projet_RFID.code-workspace
```

<a id="AUTRES"></a>

## 🗂️ Autres Programmes

```plaintext

```

<a id="BDD"></a>

## 🗂️ Programmes BDD

```plaintext
📦 Base_de_donnees_V1
 ├── 📂 .pio
 ├── 📂 .vscode
 ├── 📂 include
 │    └── README
 ├── 📂 lib
 ├── 📂 src
 │    └── Affichage.php
 │    └── AjoutColonne.php
 │    └── Get1.php
 │    └── Get2.php
 │    └── Login.php
 │    └── Login.css
 │    └── PDO.php
 │    └── PDOBDP.php
 │    └── Post1.php
 │    └── Post2.php
 │    └── Redirection.php
 │    └── Registration.php
 │    └── Registration.css
 │    └── SuppressionColonne.php
 │    └── SuppressionBDD.php
 │    └── SuppressionTable.php
 ├── .gitignore
 ├── platformio.ini
 └── Base_de_donnees_V1.code-workspace
```

```plaintext
📦 Base_de_donnees_V2
 ├── 📂 .pio
 ├── 📂 .vscode
 ├── 📂 include
 │    └── README
 ├── 📂 lib
 ├── 📂 src
 │    └── Config1.php
 │    └── Config2.php
 │    └── Insert1.php
 │    └── Insert2.php
 │    └── Ordre1.php
 │    └── Ordre2.php
 │    └── Select1.php
 │    └── Select2.php
 ├── .gitignore
 ├── platformio.ini
 └── Base_de_donnees_V2.code-workspace
```
---

<a id="FA"></a>
<div align="center"> 

## ⚙️ Fonctionnalités Attendues ⚙️

</div>

### 1. Gestion des versions :
- Au cours du projet, nous allons versionner chaque programmes, chaque fichier de sorte à pouvoir revenir en arrière en cas de besoin.
- Le versionning permet aussi aux membres de l'équipe de s'organiser dans la gestion et l'organisation du projet.
- Copies de toutes ces versions sur des systèmes de stockages hors ligne et en ligne.

### 2. Configuration Logiciels : 
- Les logiciels de programmation seront disponibles sur une VM partagée.
- Utilisation d'une clé USB pour stocker les logiciels et les configurations requises.
- Utilisation direct de nos postes utilisateurs pour installer les logiciels.

### 3. base de données :
-

### 4. Liaisons et Endpoints : 
- 

### 5. Supervision et Gestion : 
- 

### 6. Réalisation des tests : 
- 

### 7. Suggestions d’Amélioration : 
- **Automatisation** : Développement de scripts pour automatiser l'installation et la configuration.
- **Surveillance** : Mise en place d’un système de monitoring pour détecter les anomalies ou attaques en temps réel.
- **Surveillance** : Mise en place d’un système de monitoring pour détecter les anomalies ou attaques en temps réel.
---
<a id="MAINCPP"></a>

<div align="center"> 

## 👨‍💻 Main.cpp 👨‍💻

</div>

<details>
<summary><strong>Afficher le programme principal...</strong></summary>

```cpp

```
</details>

---
<a id="LINKS"></a>

<div align="center"> 

## 🔗 Documentations 🔗

</div>

- [Documentation NAS](https://drive.google.com/file/d/1tYCp2nKevAsyJZwCxPxwGxLmUTj13Kor/view?usp=sharing)
- [Documentation Node.js](https://drive.google.com/file/d/1KNOfGuRLr0bCsTYM16bYGcTcp4VLpweR/view?usp=sharing)
- [Documentation MySQL](https://drive.google.com/file/d/1smohFSQ9tKvVYNMH-ZKSqMHqFloNxiBE/view?usp=sharing)
- [Documentation VSCode](https://drive.google.com/file/d/1tscDynY2-FV8A1LixS1tJ_W-v2e-5r6W/view?usp=sharing)
- [Documentation Zabbix](https://drive.google.com/file/d/1bDWJyYu2WAbzNeDDFe5PrAnkytsfeEyR/view?usp=sharing)
- [Documentation Grafana](https://grafana.com/docs/)
- [DRIVE](https://drive.google.com/drive/folders/1EK4s1p8XXbPVbmiZznWmid2rBhrHbWuR)
- [](https://drive.google.com/drive/folders/1EK4s1p8XXbPVbmiZznWmid2rBhrHbWuR)
---

**Projet : Mini-Projet_RFID**  
Créé par : [Mathéo ALBOUY-BENALIA](https://www.bing.com/ck/a?!&&p=99669e76203929bf83d3571363284c9bd3697c91b085ede10ed2584b2b6646c4JmltdHM9MTczOTIzMjAwMA&ptn=3&ver=2&hsh=4&fclid=1185c69a-8960-6975-303d-d26788196857&psq=linkedin+math%c3%a9o+albouybenalia&u=a1aHR0cHM6Ly9mci5saW5rZWRpbi5jb20vaW4vbWF0aGVvLWFsYm91eS1iZW5hbGlhLTQ4NTI1NTJiMw&ntb=1)  
Dates : 27 janvier 2025 au 19 Juin 2025  
Licence : [BTS CIEL 2ème](https://carnus.fr)  

---

