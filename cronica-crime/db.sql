CREATE TABLE recordes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nickname VARCHAR(50) NOT NULL,
    tempo_total INT NOT NULL,
    casos_resolvidos INT DEFAULT 3,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);