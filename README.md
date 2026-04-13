# SlowDo

**SlowDo** est une "Tout Doux List" minimaliste conçue pour organiser ses journées sans stress.  
L'application mise sur une esthétique apaisante, des animations fluides et une gestion de données flexible.

## Philosophie
- **Calme** : Pas de notifications rouges, pas d'urgence.
- **Doux** : Un design aux angles arrondis et couleurs pastels.
- **Flexible** : Utilise MongoDB pour une structure de données évolutive.

## Installation (Local)

1. **Prérequis** :
   - WampServer (PHP 8.3+)
   - MongoDB Community Server & MongoDB Compass
   - Extension PHP `mongodb` activée.

2. **Installation** :
   - Clone le dépôt dans ton dossier `www/`.
   - Importe le projet dans ton navigateur via `localhost/slowdo`.

3. **Technos** :
   - **Frontend** : HTML5, Tailwind CSS, JavaScript (Vanilla).
   - **Backend** : PHP 8.3.
   - **Base de données** : MongoDB.

## Structure
- `api.php` : Gestionnaire de requêtes CRUD.
- `index.php` : Interface utilisateur principale.
- `app.js` : Interactions et animations.