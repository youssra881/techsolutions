# Site TechSolutions

Site vitrine dynamique de TechSolutions (HTML, CSS, PHP, MySQL), réalisé en BTS SIO, option SLAM. Le code est organisé comme celui de mon portfolio (header, nav, main, footer, cartes).

## Installer le site

1. Installer XAMPP, puis lancer **Apache** et **MySQL** dans le XAMPP Control Panel (les deux lignes doivent passer au vert).
2. Copier le dossier du site dans `C:\xampp\htdocs\techsolutions`.
3. Ouvrir http://localhost/phpmyadmin, onglet **Importer**, choisir `sql/techsolutions.sql`, puis **Importer**.
4. Ouvrir http://localhost/techsolutions/

## Les pages

| Fichier | Rôle |
|---|---|
| `index.php` | Accueil |
| `services.php` | Services, techniciens (lus dans la base), tarifs HT et TTC |
| `entreprise.php` | Présentation et équipe (lue dans la base) |
| `actualites.php` | Actualités du secteur |
| `contact.php` | Formulaire de contact : le message est enregistré dans la table `messages` |
| `messages.php` | Liste des messages reçus (réservé à l'administrateur) |
| `donnees.php` | Mes données : modifier mes informations et mon mot de passe (RGPD) |
| `connexion.php` | Formulaire de connexion |
| `verifier.php` | Vérifie l'identifiant et le mot de passe, ouvre la session |
| `espace.php` | Espace du salarié connecté |
| `deconnexion.php` | Ferme la session |
| `annuaire.php` | Liste des salariés (réservé aux connectés) |
| `utilisateurs.php` | Liste des comptes (réservé à l'administrateur) |
| `ajouter.php` | Formulaire d'ajout d'un compte + enregistrement (administrateur) |
| `supprimer.php` | Demande confirmation puis supprime un compte (administrateur) |

Dossier `inc/` : morceaux de code partagés.

| Fichier | Rôle |
|---|---|
| `infos.php` | Nom, téléphone, adresse de l'entreprise |
| `haut.php` | Début de chaque page (`<head>` et menu) |
| `menu.php` | Le menu |
| `pied.php` | Le bas de page |
| `bdd.php` | Connexion à MySQL (PDO) |
| `verif-connecte.php` | Renvoie vers la connexion si on n'est pas connecté |
| `verif-admin.php` | Renvoie vers l'espace si on n'est pas administrateur |

Autres dossiers : `css/style.css` (le style), `images/` (le logo), `sql/techsolutions.sql` (la base).

## Comptes de démonstration

| Identifiant | Mot de passe | Rôle |
|---|---|---|
| `mdurand` | `Admin2026` | Administrateur |
| `jmoreau`, `kbenali`, `lpetit`, `sgarcia`, `tleroy`, `cfontaine`, `nrousseau` | `Salarie2026` | Salarié |

Ce sont des comptes de test. La base ne contient que des empreintes (`password_hash`), jamais les mots de passe en clair.

## Sécurité de base

- Requêtes préparées (`prepare` et `execute`) contre l'injection SQL.
- `password_hash` et `password_verify` pour les mots de passe.
- `htmlspecialchars` pour afficher les données sans risque.
- Les pages privées commencent par `verif-connecte.php` ou `verif-admin.php`.
