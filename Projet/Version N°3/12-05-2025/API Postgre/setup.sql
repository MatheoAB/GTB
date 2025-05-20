CREATE DATABASE example_db;

\c example_db;

CREATE TABLE example_table (
    id SERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT
);

-- Insérer des données initiales
INSERT INTO example_table (name, description) VALUES
('Élément 1', 'Description de l\'élément 1'),
('Élément 2', 'Description de l\'élément 2'),
('Élément 3', 'Description de l\'élément 3');