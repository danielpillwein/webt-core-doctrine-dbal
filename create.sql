DROP TABLE player;
DROP TABLE game;

CREATE TABLE Player
(
    pk_player_id INT PRIMARY KEY,
    fname        VARCHAR(20),
    lname        VARCHAR(20)
);

CREATE TABLE Game
(
    pk_game_id   INT PRIMARY KEY,
    fk_playerOne INT,
    fk_playerTwo INT,
    moveOne      VARCHAR(8),
    moveTwo      VARCHAR(8),
    date         DATETIME,
    CONSTRAINT fk_playerOne FOREIGN KEY (fk_playerOne) REFERENCES Player (pk_player_id),
    CONSTRAINT fk_playerTwo FOREIGN KEY (fk_playerTwo) REFERENCES Player (pk_player_id)
);

INSERT INTO Player (pk_player_id, fname, lname)
VALUES (1, 'Daniel', 'Pillwein'),
       (2, 'Lukas', 'Schodl'),
       (3, 'Gabriel', 'Forstner'),
       (4, 'Matthias', 'Wagner');

INSERT INTO Game (pk_game_id, fk_playerOne, fk_playerTwo, moveOne, moveTwo, date)
VALUES (1, 1, 2, 'Rock', 'Paper', '2023-04-19 10:00:00'),
       (2, 2, 3, 'Paper', 'Scissors', '2023-04-19 10:15:00'),
       (3, 3, 4, 'Scissors', 'Rock', '2023-04-19 10:30:00'),
       (4, 4, 1, 'Paper', 'Rock', '2023-04-19 10:45:00'),
       (5, 1, 3, 'Scissors', 'Paper', '2023-04-19 11:00:00');
