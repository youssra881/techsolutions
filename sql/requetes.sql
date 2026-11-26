-- Requêtes du TP 10 (à exécuter dans phpMyAdmin : base techsolutions, onglet SQL)
USE techsolutions2;

SELECT * FROM utilisateurs;                                                      -- 8 lignes
SELECT prenom, nom FROM utilisateurs;                                            -- 8 lignes
SELECT prenom, nom FROM utilisateurs WHERE service = 'Technique';                -- 3 lignes
SELECT id, prenom, nom FROM utilisateurs ORDER BY nom;                           -- 8 lignes
SELECT * FROM utilisateurs WHERE identifiant = 'kbenali';                        -- 1 ligne
SELECT prenom, nom, service FROM utilisateurs ORDER BY service, nom;             -- 8 lignes
SELECT prenom, nom FROM utilisateurs WHERE role != 'admin';                      -- 7 lignes
SELECT prenom, nom FROM utilisateurs WHERE service = 'Commercial' ORDER BY prenom; -- 2 lignes
