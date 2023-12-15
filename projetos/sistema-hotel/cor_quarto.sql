USE quartos;

CREATE TABLE cor_quarto (
    id INT AUTO_INCREMENT PRIMARY KEY,
    quarto_id INT,
    cor VARCHAR(20),
    UNIQUE KEY quarto_id (quarto_id),
    FOREIGN KEY (quarto_id) REFERENCES quartos(id)
);
