DROP TABLE IF EXISTS notes;

CREATE TABLE notes (
  notesId INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
  clientId INT REFERENCES client(clientId),
  clientName VARCHAR(50) REFERENCES client(clientName),
  notes VARCHAR(500)
);
