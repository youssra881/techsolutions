-- Base du site de référence TechSolutions (version 2, bleu et blanc)
-- Le fichier d'origine avait disparu : ce script recrée les tables dont les pages ont besoin.
-- phpMyAdmin > Importer (ou ligne de commande). Attention : recrée les tables.
CREATE DATABASE IF NOT EXISTS techsolutions2 CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE techsolutions2;

DROP TABLE IF EXISTS messages, clients, pages, services, textes, actualites, utilisateurs;

CREATE TABLE utilisateurs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    identifiant VARCHAR(30) NOT NULL UNIQUE,
    mot_de_passe VARCHAR(255) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    nom VARCHAR(50) NOT NULL,
    service VARCHAR(50) NOT NULL,
    role VARCHAR(10) NOT NULL
);
INSERT INTO utilisateurs (identifiant, mot_de_passe, prenom, nom, service, role) VALUES
('mdurand', '$2y$10$8efjRCz/DQeIi.6TCqPPiO8crX84acHbKe5wGV3T7BUlzpMe9hxWW', 'Martin', 'Durand', 'Informatique', 'admin'),
('jmoreau', '$2y$10$1IFUf30NlciWsBb8xFLg9.kTYUnMTqP0FaDi.KjUy7Y25CPXf8TuC', 'Julie', 'Moreau', 'Accueil', 'salarie'),
('kbenali', '$2y$10$UO.SaAKfiqvt2W8mp1D/p.27S8WG8z3JwLhxp4nF5GenoAkGJdAgy', 'Karim', 'Benali', 'Comptabilité', 'salarie'),
('lpetit', '$2y$10$NJIWyOzQtnhvcv2mGg5QSu8tHELE9eLAu3stQZsDG7snVsZa3H8ta', 'Lucas', 'Petit', 'Technique', 'salarie'),
('sgarcia', '$2y$10$wzb3foPXxWIwXVfeKFfoFe36ZfvudcSMGGCvWeXyNEF/p6zp7CVt2', 'Sofia', 'Garcia', 'Technique', 'salarie'),
('tleroy', '$2y$10$DrqrZQW59A.pw1MjyXbUyOKy4Zrlu9ANcn0H8uIB52QHoVlaLxBI6', 'Thomas', 'Leroy', 'Technique', 'salarie'),
('cfontaine', '$2y$10$70dy1amCh9Jiv9Vn7KkNbeDHqZvojxg.U1OYq2HqUPZUrHfuVcYYW', 'Camille', 'Fontaine', 'Commercial', 'salarie'),
('nrousseau', '$2y$10$YhRrClnD4ZYuOtgkEwLCreoE/oGIbe6AFr58Q21flkw7Up8Nm2jBa', 'Nadia', 'Rousseau', 'Commercial', 'salarie');

CREATE TABLE messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL,
    sujet VARCHAR(150) NOT NULL DEFAULT '',
    message TEXT NOT NULL,
    date_envoi DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE clients (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(150) NOT NULL UNIQUE,
    mot_de_passe VARCHAR(255) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    nom VARCHAR(50) NOT NULL,
    entreprise VARCHAR(100) NOT NULL DEFAULT '',
    telephone VARCHAR(30) NOT NULL DEFAULT '',
    date_inscription DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE pages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL UNIQUE,
    contenu TEXT NOT NULL
);
INSERT INTO pages (nom, contenu) VALUES
('accueil', 'TechSolutions accompagne les petites entreprises de la région de Brive dans la gestion de leur informatique : installation, maintenance, sauvegarde et assistance.'),
('entreprise', 'TechSolutions a été créée à Brive-la-Gaillarde par deux techniciens. Aujourd''hui, l''entreprise compte une trentaine de salariés et s''occupe de plus de cent clients.');

CREATE TABLE services (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(100) NOT NULL,
    description TEXT NOT NULL,
    ordre INT NOT NULL DEFAULT 0
);
INSERT INTO services (titre, description, ordre) VALUES
('Maintenance des postes de travail', 'Entretien, mises à jour et dépannage des ordinateurs.', 1),
('Réseaux', 'Installation et suivi des réseaux de l''entreprise.', 2),
('Sauvegarde des données', 'Sauvegardes régulières et restauration en cas de panne.', 3),
('Assistance aux utilisateurs', 'Aide par téléphone pour les salariés.', 4);

CREATE TABLE textes (
    cle VARCHAR(50) PRIMARY KEY,
    valeur TEXT NOT NULL
);
INSERT INTO textes (cle, valeur) VALUES
('accueil_titre', 'Votre informatique entre de bonnes mains'),
('accueil_texte', 'Des solutions informatiques pour accompagner les entreprises au quotidien.'),
('entreprise_texte', 'TechSolutions a été créée à Brive-la-Gaillarde par deux techniciens.');

CREATE TABLE actualites (
    id INT AUTO_INCREMENT PRIMARY KEY,
    categorie VARCHAR(60) NOT NULL DEFAULT '',
    titre VARCHAR(200) NOT NULL,
    resume TEXT NOT NULL,
    source VARCHAR(100) NOT NULL DEFAULT '',
    lien VARCHAR(255) NOT NULL DEFAULT '',
    date_pub DATE NOT NULL DEFAULT (CURRENT_DATE),
    source_nom VARCHAR(100) NOT NULL DEFAULT '',
    source_url VARCHAR(255) NOT NULL DEFAULT '',
    date_maj DATE NOT NULL DEFAULT (CURRENT_DATE)
);
INSERT INTO actualites (categorie, titre, resume, source, lien, date_pub, source_nom, source_url, date_maj)
SELECT categorie, titre, resume, source, lien, CURRENT_DATE, source, lien, CURRENT_DATE FROM techsolutions.actualites;