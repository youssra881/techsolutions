-- Base de données du site TechSolutions
-- À importer dans phpMyAdmin : onglet « Importer » (ou onglet « SQL »).

CREATE DATABASE IF NOT EXISTS techsolutions
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_general_ci;

USE techsolutions;

-- La table des utilisateurs
CREATE TABLE IF NOT EXISTS utilisateurs (
  id INT AUTO_INCREMENT PRIMARY KEY,
  identifiant VARCHAR(30) NOT NULL UNIQUE,
  mot_de_passe VARCHAR(255) NOT NULL,
  prenom VARCHAR(50) NOT NULL,
  nom VARCHAR(50) NOT NULL,
  service VARCHAR(50) NOT NULL,
  role VARCHAR(10) NOT NULL
);

-- La table des messages envoyés par le formulaire de contact
CREATE TABLE IF NOT EXISTS messages (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nom VARCHAR(100) NOT NULL,
  email VARCHAR(150) NOT NULL,
  message TEXT NOT NULL,
  date_envoi DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

-- Les comptes de départ (les mots de passe sont des empreintes, pas du texte clair)
-- INSERT IGNORE : si le compte existe déjà, il n'est pas recréé.
INSERT IGNORE INTO utilisateurs (identifiant, mot_de_passe, prenom, nom, service, role) VALUES
('mdurand', '$2y$10$8efjRCz/DQeIi.6TCqPPiO8crX84acHbKe5wGV3T7BUlzpMe9hxWW', 'Martin', 'Durand', 'Informatique', 'admin'),
('jmoreau', '$2y$10$1IFUf30NlciWsBb8xFLg9.kTYUnMTqP0FaDi.KjUy7Y25CPXf8TuC', 'Julie', 'Moreau', 'Accueil', 'salarie'),
('kbenali', '$2y$10$UO.SaAKfiqvt2W8mp1D/p.27S8WG8z3JwLhxp4nF5GenoAkGJdAgy', 'Karim', 'Benali', 'Comptabilité', 'salarie'),
('lpetit', '$2y$10$NJIWyOzQtnhvcv2mGg5QSu8tHELE9eLAu3stQZsDG7snVsZa3H8ta', 'Lucas', 'Petit', 'Technique', 'salarie'),
('sgarcia', '$2y$10$wzb3foPXxWIwXVfeKFfoFe36ZfvudcSMGGCvWeXyNEF/p6zp7CVt2', 'Sofia', 'Garcia', 'Technique', 'salarie'),
('tleroy', '$2y$10$DrqrZQW59A.pw1MjyXbUyOKy4Zrlu9ANcn0H8uIB52QHoVlaLxBI6', 'Thomas', 'Leroy', 'Technique', 'salarie'),
('cfontaine', '$2y$10$70dy1amCh9Jiv9Vn7KkNbeDHqZvojxg.U1OYq2HqUPZUrHfuVcYYW', 'Camille', 'Fontaine', 'Commercial', 'salarie'),
('nrousseau', '$2y$10$YhRrClnD4ZYuOtgkEwLCreoE/oGIbe6AFr58Q21flkw7Up8Nm2jBa', 'Nadia', 'Rousseau', 'Commercial', 'salarie');
