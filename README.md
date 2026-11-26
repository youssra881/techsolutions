# Site TechSolutions (deuxième version)

Site vitrine dynamique de TechSolutions (HTML, CSS, PHP, MySQL), fait pour le cahier des charges : présentation de l'entreprise, actualités, formulaire de contact, partie administrateur et partie client (RGPD).


## Installer le site

**Windows**
1. Ouvrir **XAMPP Control Panel**, cliquer sur **Start** pour **Apache** et **MySQL** (les deux lignes passent au vert).
2. Le dossier du site doit être dans `C:\xampp\htdocs\TechSolutions exemple`.

**Mac**
1. Ouvrir **XAMPP**, onglet **Manage Servers**, démarrer **Apache Web Server** et **MySQL Database**.
2. Le dossier du site doit être dans `/Applications/XAMPP/xamppfiles/htdocs/TechSolutions exemple`.

**Ensuite (Windows et Mac)**
3. Ouvrir http://localhost/phpmyadmin, onglet **Importer**, choisir `sql/techsolutions.sql`, puis **Importer**.
4. Ouvrir http://localhost/TechSolutions%20exemple/ (ou double-cliquer sur `Ouvrir le site (Windows).url` ou `Ouvrir le site (Mac).webloc`).

## Les pages

| Fichier | Rôle |
|---|---|
| `index.php` | Accueil (texte lu dans la base) |
| `services.php` | Services et techniciens (lus dans la base) |
| `entreprise.php` | Présentation (lue dans la base) et équipe |
| `actualites.php` | Actualités (lues dans la base) |
| `contact.php` | Formulaire de contact : le message est enregistré dans la table `messages` |
| `confidentialite.php` | RGPD : données enregistrées et droits |
| `client.php`, `verifier-client.php` | Connexion d'un client |
| `inscription.php` | Création d'un compte client |
| `compte.php` | Le client modifie ses données ou supprime son compte |
| `connexion.php`, `verifier.php` | Connexion d'un salarié |
| `espace.php`, `annuaire.php`, `donnees.php` | Espace du salarié, annuaire, modification de ses données |
| `utilisateurs.php`, `ajouter.php`, `supprimer.php` | Administrateur : comptes des salariés |
| `clients.php` | Administrateur : liste et suppression des clients |
| `messages.php` | Administrateur : messages reçus |
| `contenu.php` | Administrateur : modifier les textes, publier ou supprimer une actualité |
| `deconnexion.php` | Ferme la session |

Dossier `inc/` : `infos.php` (nom, téléphone, adresse), `haut.php`, `menu.php`, `pied.php`, `bdd.php` (connexion à MySQL), `verif-connecte.php`, `verif-admin.php`, `verif-client.php` (protection des pages).

Autres : `css/style.css` (style), `images/logo.png`, `sql/techsolutions.sql` (la base).

## Les tables de la base

`utilisateurs` (salariés), `clients`, `messages`, `pages` (textes de l'accueil et de l'entreprise), `actualites`.

## Comptes de démonstration

| Type | Identifiant | Mot de passe |
|---|---|---|
| Administrateur | `mdurand` | `Admin2026` |
| Salariés | `jmoreau`, `kbenali`, `lpetit`, `sgarcia`, `tleroy`, `cfontaine`, `nrousseau` | `Salarie2026` |
| Client | `claire.dupuis@exemple.fr` | `Client2026` |

La base ne contient que des empreintes (`password_hash`), jamais les mots de passe en clair.

## Sécurité et RGPD

- Requêtes préparées (`prepare` et `execute`) contre l'injection SQL.
- `password_hash` et `password_verify` pour les mots de passe.
- `htmlspecialchars` pour afficher les données sans risque.
- Les pages privées commencent par `verif-connecte.php`, `verif-admin.php` ou `verif-client.php`.
- Une case à cocher (accord) est obligatoire pour envoyer un message ou créer un compte.
- Le client peut modifier ses données et supprimer son compte (ses messages sont supprimés avec).

## Test rapide

1. Contact : envoyer un message sans cocher la case (refusé), puis en la cochant (accepté).
2. Se connecter en administrateur : le message est dans **Messages**.
3. **Contenu** : changer le texte de l'accueil et publier une actualité, puis vérifier les pages.
4. Créer un compte client, modifier son nom, puis supprimer le compte.
