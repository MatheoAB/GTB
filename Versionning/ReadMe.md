# Git_Versions


[![Développement Web](https://img.shields.io/badge/HTML-CSS-yellow)](https://www.w3.org/)
[![Python Versions](https://img.shields.io/badge/Python-3-blue)](https://www.python.org/)

[![Markdown](https://img.shields.io/badge/M%20⬇-191970)](https://www.carnus.fr/)
[![GitHub git](https://img.shields.io/badge/GitHub-git-fd5800)](https://www.carnus.fr/)

# Dossier Web :
## V0 : Version fournie
## V1 :
- Ajouter cette table au fichier `index.html`
  - Modifier le fichier HTML
  - Modifier le fichier CSS
  - Dans ce fichier MarkDown, ajouter l'arborescence de votre dossier

| Matière | Volume horaire [h] | Coefficient |
|--|--|--|
| Anglais | 3 | 3 |
| Maths | 2 | 2 |
| Physique | 4 | 3 |
| Info. et Réseaux | 15 | 10 |

## V2 :
- Ajouter au début du tableau une ligne pour la matière CGE
- Ajouter une image au fichier HTML
  - Modifier le fichier HTML
  - Modifier le fichier CSS

---

# Dossier Py :
## V0 : Version fournie
## V1 :
- Tracer la courbe du signal sinusoïdal $s(t)=a.sin(2\pi .f .t)$
  - Modifier le fichier `code.ipynb`
  - Modifier le fichier `ReadMe.md` pour inclure les lignes de code

## V2 :
- Tracer la courbe du signal sinusoïdal $s(t)=a.sin(2\pi .f .t+\frac{\pi}{3})$
  - Modifier le fichier `code.ipynb`

---

# Arborescence du dossier  :

```
📦Versionning
 ┣ 📂Py
 ┃ ┗ 📜code.ipynb
 ┣ 📂Web
 ┃ ┣ 📜index.html
 ┃ ┗ 📜style.css
 ┣ 📜CES.jpg
 ┣ 📜Git_Exp.pdf
 ┗ 📜ReadMe.md
```

---

# Codes Python :

### Programme python Version N°1 :

```
import matplotlib.pyplot as plt
import numpy as np

# Paramètres du signal
a = 1.0  # Amplitude
f = 1.0  # Fréquence en Hz
t = np.linspace(0, 1, 1000)  # Intervalle de temps

# Signal sinusoïdal
s = a * np.sin(2 * np.pi * f * t)

# Tracé du signal
plt.figure(figsize=(10, 4))
plt.plot(t, s, label='s(t) = a.sin(2π.f.t)')
plt.title('Signal Sinusoïdal')
plt.xlabel('Temps (s)')
plt.ylabel('Amplitude')
plt.grid(True)
plt.legend()
plt.show()
```

### Programme python Version N°2 :

```
import matplotlib.pyplot as plt
import numpy as np

# Paramètres du signal
a = 1.0  # Amplitude
f = 1.0  # Fréquence en Hz
t = np.linspace(0, 1, 1000)  # Intervalle de temps

# Signal sinusoïdal
s = a * np.sin(2 * np.pi * f * t + np.pi / 3)

# Tracé du signal
plt.figure(figsize=(10, 4))
plt.plot(t, s, label='s(t) = a.sin(2π.f.t + π/3)')
plt.title('Signal Sinusoïdal')
plt.xlabel('Temps (s)')
plt.ylabel('Amplitude')
plt.grid(True)
plt.legend()
plt.show()
```

---

<git>[ Mon GitHub](https://github.com/MatheoAB/GTB) ↗️ </git>

## Dernière modification du fichier MarkDown à 15h20 le mardi 04/03/2025.