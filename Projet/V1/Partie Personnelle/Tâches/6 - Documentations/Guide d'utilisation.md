<a id="LLM"></a>
<div align="center"> 

# 🛜 Markdown - Partie Réseau 🛜
</div>

---

<div align="center"> 

## 💻 Logiciels / Langages / Matériel 💻


[![Développement Web](https://img.shields.io/badge/HTML-CSS-yellow)](https://www.w3.org/) [![PHP SQL](https://img.shields.io/badge/PHP-MySQL-8A2BE2)](https://www.php.net/) [![C CPP](https://img.shields.io/badge/C-C++-7b68ee)](https://www.cpp.org/)
![Visual Studio Code](https://img.shields.io/badge/Visual%20Studio%20Code-2a52be) [![C++ Arduino](https://img.shields.io/badge/C++-Arduino-teal)](https://docs.arduino.cc/) 
[![ESP32](https://img.shields.io/badge/ESP32-green)](https://www.espressif.com/en/products/socs/esp32) [![RPi](https://img.shields.io/badge/Raspberry%20Pi-1b4d3e)](https://www.raspberrypi.com/)
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

Le projet vise à concevoir un système de contrôle d'accès et de surveillance dynamique, pilotable via un outil informatique. Ce système comprend plusieurs points de contrôle stratégiquement répartis dans les zones clés de la salle 215. Il permet également d'afficher des informations, des vidéos, et des images pour signaler des événements spécifiques.

<a id="CC"></a>

## <cite><font color="#F2A900"> Tâches à accomplir : </font></cite>

|Tâche-3 (M.A.-B.)| Fonctions à développer et tâches à effectuer|
| -------------- |:----------------------------------------|
| Réseaux | Installation du serveur Linux virtualisé       |
|  | Services Web sur serveur                              |
|  | Services SGBD                                         |
|  | Configuration des serveurs Linux, Web, MySQL          |
|  |Documentation logicielle                               |
|  |Rédaction d'un rapport                                 |


---
<a id="ARCHI"></a>

## 🗂️ Architecture du Projet

```plaintext
📦 Projet_RFID
 ├── 📂 .pio
 ├── 📂 .vscode
 ├── 📂 include
 │    └── README
 ├── 📂 lib
 │    └── esp32_arduino_sqlite3_lib-master
 |    └── ESPAsyncWebServer-master
 |    └── MySQL_Connector_Arduino-master
 |    └── rfid-master
 ├── 📂 src
 │    └── main.cpp
 ├── .gitignore
 ├── platformio.ini
 └── Projet_RFID.code-workspace
```

<a id="AUTRES"></a>

## 🗂️ Autres Programmes

```plaintext
📦 ESP32_WebServer
 ├── 📂 .pio
 ├── 📂 .vscode
 ├── 📂 include
 │    └── README
 ├── 📂 lib
 │    └── esp32_arduino_sqlite3_lib-master
 |    └── ESPAsyncWebServer-master
 |    └── MySQL_Connector_Arduino-master
 |    └── rfid-master
 ├── 📂 src
 │    └── main.cpp
 ├── .gitignore
 ├── platformio.ini
 └── ESP32_WebServer.code-workspace
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

## ⚙️ Fonctionnalités Attendues ⚙️
</div>

### 1. Installation du Serveur Linux Virtualisé
- Création d'une machine virtuelle à l'aide de Proxmox et installation d'Ubuntu Server.
- Configuration réseau et installation des paquets de base.
- Adaptation avec un Raspberry Pi 4 pour contourner les restrictions et permettre une connectivité flexible (Wi-Fi ou Ethernet).
- Installation et utilisation d'une base de données locale sur un poste administrateur sous Windows, suite à des limitations rencontrées avec l'ESP32.

### 2. Installation et Configuration des Services Web
- Déploiement d'Apache via XAMPP pour une configuration simple et rapide.
- Intégration d'Apache avec une base de données MySQL.
- Validation du fonctionnement en accédant à la page par défaut via une adresse IP sur un réseau sécurisé utilisant une borne Wi-Fi.

### 3. Documentation Logicielle
- Création d'une documentation complète détaillant :
  - Les commandes utilisées.
  - Les configurations appliquées.
  - Les solutions aux problèmes rencontrés.
  - Les phases de test et les mesures de sécurisation du réseau et des programmes.

### 4. Rédaction d’un Rapport Final
- Résumé des objectifs, déroulé, résultats, et enseignements tirés.
- Inclusion d’exemples pratiques et de captures d’écran pour illustrer les aspects techniques.
- Création d’un planning personnel pour tracer les différentes étapes.

### 5. Gestion des Difficultés
- Résolution des restrictions réseau et des permissions MySQL bloquant les connexions distantes.
- Configuration manuelle pour éditer les permissions et ajouter des utilisateurs avec accès complet.

### 6. Résultats et Enseignements
- Développement d'un environnement fonctionnel, documenté, et reproductible.
- Consolidation des compétences en administration système et réseau.
- Résolution de problèmes techniques inhabituels dans des environnements spécifiques.

### 7. Suggestions d’Amélioration
- **Automatisation** : Développement de scripts pour automatiser l'installation et la configuration.
- **Surveillance** : Mise en place d’un système de monitoring pour détecter les anomalies ou attaques en temps réel.

---
<a id="MAINCPP"></a>

<div align="center"> 

## 👨‍💻 Main.cpp 👨‍💻

</div>

<details>
<summary><strong>Afficher le programme principal...</strong></summary>

```cpp
// Librairies
#include <WiFi.h>
#include <SPI.h>
#include <MFRC522.h>
#include <MySQL_Connection.h>
#include <MySQL_Cursor.h>

// Définir les broches de connexion RFID pour l'ESP32
#define SS_PIN 21  // SDA (SS)
#define RST_PIN 22 // RST

// Configuration du module RFID
MFRC522 rfid(SS_PIN, RST_PIN);

// UID des cartes autorisées
byte carteAutorisee1[4] = {0xE9, 0xE5, 0x0B, 0xE5};
byte carteAutorisee2[4] = {0xE5, 0xB6, 0x03, 0x10};

// Configuration réseau
const char* ssid = "TP-LINK_215";
const char* password = "CIEL1234#+";

// Configuration base de données MySQL distante
IPAddress server_addr(172, 40, 1, 30);  // IP de ton serveur MySQL
char user[] = "root";                     // Nom d'utilisateur MySQL
char dbPassword[] = "root";         // Mot de passe MySQL
char database[] = "rfid";              // Nom de la base de données
WiFiClient client;
MySQL_Connection conn((Client *)&client);
MySQL_Cursor* cursor;

// Serveur Web.
WiFiServer server(80);

// Fonctions
bool verifierCarte(byte *uidLue, byte taille, byte *carteAutorisee);
void ajouterEntree(String uid, String statut);
String genererPageHTML();

void setup() {
  Serial.begin(115200);
  SPI.begin();
  rfid.PCD_Init();

  // Connexion WiFi
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
    delay(1000);
    Serial.println("Connexion en cours...");
  }
  Serial.println("Connecté au WiFi!");
  Serial.print("Adresse IP : ");
  Serial.println(WiFi.localIP());

//Connexion à la base de données MySQL

  Serial.println("Connexion à MySQL...");
  if (conn.connect(server_addr, 3306, user, dbPassword, database)) {
    Serial.println("Connecté à la base de données MySQL.");
    cursor = new MySQL_Cursor(&conn);
  } else {
    Serial.println("Erreur de connexion à la base de données MySQL.");
  }

  // Démarrage du serveur Web
  server.begin();
}

void loop() {
  // Lecture de la carte RFID
  if (!rfid.PICC_IsNewCardPresent() || !rfid.PICC_ReadCardSerial()) {
    return;
  }

  // Stocker l'UID lue sous forme de chaîne
  String uidLue = "";
  for (byte i = 0; i < rfid.uid.size; i++) {
    uidLue += String(rfid.uid.uidByte[i] < 0x10 ? " 0" : " ");
    uidLue += String(rfid.uid.uidByte[i], HEX);
  }
  uidLue.trim();

  // Vérification de la carte
  String statut;
  if (verifierCarte(rfid.uid.uidByte, rfid.uid.size, carteAutorisee1)) {
    statut = "Accès autorisé";
  } else if (verifierCarte(rfid.uid.uidByte, rfid.uid.size, carteAutorisee2)) {
    statut = "Accès refusé";
  } else {
    statut = "Carte non reconnue - Accès refusé";
  }

  // Ajouter l'entrée dans la base de données
  ajouterEntree(uidLue, statut);

  // Affichage dans le moniteur série
  Serial.println(statut + " pour carte : " + uidLue);

  rfid.PICC_HaltA();

  // Gestion du serveur web
  WiFiClient client = server.available();
  if (client) {
    if (client.connected()) {
      // Générer la page HTML et l'envoyer au client
      client.println("HTTP/1.1 200 OK");
      client.println("Content-Type: text/html");
      client.println();
      client.print(genererPageHTML());
      client.stop();
    }
  }
}
 // Vérification de la carte RFID
bool verifierCarte(byte *uidLue, byte taille, byte *carteAutorisee) {
  if (taille != 4) return false;
  for (byte i = 0; i < taille; i++) {
    if (uidLue[i] != carteAutorisee[i]) return false;
  }
  return true;
}

 // Inscription dans la base de données.
void ajouterEntree(String uid, String statut) {
  char query[256];
  snprintf(query, sizeof(query), "INSERT INTO historique (uid, statut, timestamp) VALUES ('%s', '%s', NOW())", uid.c_str(), statut.c_str());

  // Exécuter la requête SQL
  cursor->execute(query);
}

 // Génération de la page html pour afficher un historique des saisies.
String genererPageHTML() {
  String html = "<html><head><meta http-equiv='refresh' content='5'>";
  html += "<style>table, th, td {border: 1px solid black; border-collapse: collapse; padding: 5px;}</style></head>";
  html += "<body><h1>Historique des accès RFID</h1>";
  html += "<table><tr><th>UID</th><th>Statut</th><th>Timestamp</th></tr>";

  // Requête pour récupérer les 10 dernières entrées.
  char query[] = "SELECT uid, statut, timestamp FROM historique ORDER BY id DESC LIMIT 10";
  cursor->execute(query);
  
  // Extraire les résultats et les ajouter à la page HTML.
  column_names *cols = cursor->get_columns();
  row_values *row = NULL;
  
  while ((row = cursor->get_next_row())) {
    html += "<tr><td>" + String(row->values[0]) + "</td><td>" + String(row->values[1]) + "</td><td>" + String(row->values[2]) + "</td></tr>";
  }

  html += "</table></body></html>";
  return html;
}
```
</details>

---
<a id="LINKS"></a>

<div align="center"> 

## 🔗 Liens Utiles 🔗

</div>

- [Documentation ESP32](https://www.espressif.com/en/products/socs/esp32)
- [DRIVE](https://drive.google.com/drive/folders/1FQuh7yTAb8-2iWqrpQ_k7F6g7_KdQTTM?usp=drive_link)
---

**Projet : Mini-Projet_RFID**  
Créé par : [Mathéo ALBOUY-BENALIA](https://drive.google.com/drive/folders/1FQuh7yTAb8-2iWqrpQ_k7F6g7_KdQTTM?usp=drive_link)  
Date : 6 janvier 2025  
Licence : [BTS CIEL 2ème](https://carnus.fr)  

---